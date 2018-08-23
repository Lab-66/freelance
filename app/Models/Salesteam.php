<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;

class Salesteam extends Model
{
    use SoftDeletes,RevisionableTrait;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');
    protected $table = 'sales_teams';

    protected $casts = [
        'leads' => 'boolean',
        'quotations' => 'boolean',
        'opportunities' => 'boolean',
        'team_members' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teamLeader()
    {
        return $this->belongsTo(User::class, 'team_leader');
    }
    public function actualInvoice()
    {
        return $this->hasMany(Invoice::class,'sales_team_id')->where('invoice_date','LIKE', date('Y-m').'%');
    }
}