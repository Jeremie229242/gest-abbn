<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionNotification;
use Illuminate\Http\Request;

class SubscriptionNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = SubscriptionNotification::with('subscription.client')
            ->orderByDesc('sent_at')
            ->get();

        return view('Admin.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionNotification  $subscriptionNotification
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionNotification $subscriptionNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionNotification  $subscriptionNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionNotification $subscriptionNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionNotification  $subscriptionNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionNotification $subscriptionNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionNotification  $subscriptionNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionNotification $subscriptionNotification)
    {
        //
    }
}
