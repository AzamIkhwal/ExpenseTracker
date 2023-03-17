<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    // Daily Data
    public function scopeDailyReportData($query, $filterDate)
    {
        return $query->whereDate('date', $filterDate);
    }
    // Monthly Data
    public function scopeMonthlyReportData($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
