<?php

namespace App;

use App\Company;
use App\LastLogin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /** 
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function last_logins()
    {
        return $this->hasMany(LastLogin::class);
    }

    public function scopeWithLastLoginAt($query)
    {
        
        $query->addSelect(['last_logins_at' => LastLogin::select('created_at')
            ->whereColumn('user_id', 'id')
            ->latest()
            ->first()
        ]);
        // ->withCasts(['last_login_at' => 'datetime']);
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }


    public function scopeOrderByEmail($query)
    {
        $query->orderBy('email');
    }

    public function scopeOrderByCompany($query)
    {
        $query->orderBySub(Company::select('name')->whereRaw('users.company_id = companies.id'));
    }

    public function scopeOrderByDate($query)
    {
        $query->latest();
    }


    public function scopeOrderByField($query, $field)
    {
        if ($field === 'name') {
            $query->orderByName();
        } elseif ($field === 'company') {
            $query->orderByCompany();
        } elseif ($field === 'date') {
            $query->orderByDate();
        } elseif ($field === 'email') {
            $query->orderByEmail();
        }
    }

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where(function ($query) use ($term) {
                $query->where('name', 'like', '%'.$term.'%')
                    ->orWhereHas('company', function ($query) use ($term) {
                        $query->where('name', 'like', '%'.$term.'%');
                    });
            });
        }
    }

    public function scopeWhereFilters($query, array $filters)
    {
        $filters = collect($filters);

        $query->when($filters->get('search'), function ($query, $search) {
            $query->whereSearch($search);
        });
    }
    
}
