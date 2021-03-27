<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $casts = [
        'birth_date' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function lastInteraction()
    {
        return $this->hasOne(Interaction::class, 'id', 'last_interaction_id');
    }

    public function scopeWithLastInteraction($query)
    {
        $query->addSubSelect('last_interaction_id', Interaction::select('id')
            ->whereRaw('customer_id = customers.id')
            ->latest()
        )->with('lastInteraction');
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }

    public function scopeOrderByCompany($query)
    {
        $query->orderBySub(Company::select('name')->whereRaw('customers.company_id = companies.id'));
    }

    public function scopeOrderByBirthday($query)
    {
        $query->orderbyRaw("DATE_FORMAT('d-m-Y',birth_date)");
    }

    public function scopeOrderByLastInteractionDate($query)
    {
        $query->orderBySubDesc(Interaction::select('created_at')->whereRaw('customers.id = interactions.customer_id')->latest());
    }

    public function scopeOrderByField($query, $field)
    {
        if ($field === 'name') {
            $query->orderByName();
        } elseif ($field === 'company') {
            $query->orderByCompany();
        } elseif ($field === 'birthday') {
            $query->orderByBirthday();
        } elseif ($field === 'last_interaction') {
            $query->orderByLastInteractionDate();
        }
    }

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where(function ($query) use ($term) {
                $query->where('first_name', 'like', '%'.$term.'%')
                   ->orWhere('last_name', 'like', '%'.$term.'%')
                   ->orWhereHas('company', function ($query) use ($term) {
                       $query->where('name', 'like', '%'.$term.'%');
                   });
            });
        }
    }

    public function scopeWhereBirthdayThisWeek($query)
    {
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();

        $dates = collect(new \DatePeriod($start, new \DateInterval('P1D'), $end))->map(function ($date) {
            return $date->format('md');
        });

        return $query->whereNotNull('birth_date')->whereIn(\DB::raw("DATE_FORMAT('d-m-Y',birth_date)"), $dates);
    }

    public function scopeWhereFilters($query, array $filters)
    {
        $filters = collect($filters);

        $query->when($filters->get('search'), function ($query, $search) {
            $query->whereSearch($search);
        })->when($filters->get('filter') === 'birthday_this_week', function ($query, $filter) {
            $query->whereBirthdayThisWeek();
        });
    }

    public function scopeVisibleTo($query, User $user)
    {
        if ($user->is_admin) {
            return $query;
        }

        return $query->where('sales_rep_id', $user->id);
    }
}
