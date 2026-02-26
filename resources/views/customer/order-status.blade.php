@extends('layouts.customer')

@section('title', 'Order ' . substr($order->order_number, -2) . ' — DND Cafe')

@section('top-bar')
    <div class="brand">DND CAFE</div>
    <div class="table-badge">{{ $order->table->name }}</div>
@endsection

@section('content')
    <div class="order-page">

        {{-- Order Header --}}
        <div class="order-header">
            <div class="order-number">
                <h3>{{ $order->table->name }} <span class="text-amber-600">•</span> Order - {{ substr($order->order_number, -2) }}</h3>
            </div>
            <div class="order-meta">
                <span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $order->created_at->format('h:i A') }}
                </span>
                <span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $order->created_at->format('d M Y') }}
                </span>
            </div>
        </div>

        @if($order->status === 'cancelled')
            {{-- Cancelled State --}}
            <div class="cancelled-banner">
                <div class="icon">⚠️</div>
                <h3>Order Cancelled</h3>
                <p>This order has been cancelled and will not be prepared.</p>
            </div>

        @else
            {{-- Status Progress --}}
            <div class="status-progress">
                <div class="progress-title">Order Progress</div>

                <div class="status-track {{ $order->status }}">
                    @php
                        $statuses = ['pending', 'confirmed', 'preparing', 'ready', 'delivered'];
                        $currentIndex = array_search($order->status, $statuses);
                    @endphp

                    @foreach(['pending', 'confirmed', 'preparing', 'ready', 'delivered'] as $status)
                        @php
                            $statusIndex = array_search($status, $statuses);
                            $isCompleted = $statusIndex < $currentIndex;
                            $isActive = $status === $order->status;
                        @endphp
                        <div class="status-step {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}">
                            <div class="status-icon">
                                @if($status === 'pending')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                @elseif($status === 'confirmed')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @elseif($status === 'preparing')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                @elseif($status === 'ready')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                @elseif($status === 'delivered')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M5 13l4 4L19 7"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="status-label">{{ ucfirst($status) }}</div>
                        </div>
                    @endforeach                
                </div>

                <div class="current-status">
                    @if($order->status === 'pending')
                        <div class="status-emoji">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="status-text">Order Received!</div>
                        <div class="status-subtext">We've got your order and the kitchen will confirm it shortly.</div>
                    @elseif($order->status === 'confirmed')
                        <div class="status-emoji">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="status-text">Order Confirmed!</div>
                        <div class="status-subtext">Kitchen has confirmed your order and will start preparing soon.</div>
                    @elseif($order->status === 'preparing')
                        <div class="status-emoji">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="status-text">Preparing Your Food</div>
                        <div class="status-subtext">Your delicious food is being prepared right now!</div>
                    @elseif($order->status === 'ready')
                        <div class="status-emoji">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <div class="status-text">Order Ready!</div>
                        <div class="status-subtext">Your order is ready and will be delivered to your table shortly.</div>
                    @elseif($order->status === 'delivered')
                        <div class="status-emoji">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="status-text">Order Delivered!</div>
                        <div class="status-subtext">Enjoy your meal! Thank you for dining with us.</div>
                    @endif
                </div>            
            </div>
        @endif

        {{-- Order Items --}}
        <h2 class="section-title">Your Order</h2>
        <div class="items-box">
            @foreach($order->items as $item)
                <div class="order-item">
                    <div class="item-qty">{{ $item->quantity }}×</div>
                    <div class="item-details">
                        <div class="item-name">{{ $item->menuItem->name }}</div>
                        @if($item->notes)
                            <div class="item-notes">📝 {{ $item->notes }}</div>
                        @endif
                    </div>
                    <div class="item-price">₹{{ number_format($item->subtotal, 0) }}</div>
                </div>
            @endforeach
        </div>

        {{-- Order Notes --}}
        @if($order->notes)
            <div class="notes-box">
                <div class="label">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Special Instructions
                </div>
                <div class="content">{{ $order->notes }}</div>
            </div>
        @endif

        {{-- Totals --}}
        <div class="totals-box">
            <div class="total-row">
                <span>Subtotal</span>
                <span>₹{{ number_format($order->subtotal, 0) }}</span>
            </div>

            <div class="total-row final">
                <span class="label">Total</span>
                <span class="value">₹{{ number_format($order->total, 0) }}</span>
            </div>

            <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <span style="font-size: 0.8rem; color: rgba(255,255,255,0.6);">Payment Status</span>
                    <span class="payment-badge {{ $order->payment_status }}">
                        {{ $order->payment_status === 'paid' ? '✓ Paid' : '💰 Pay at Counter' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Auto Refresh (only if order not delivered/cancelled) --}}
        @if(!in_array($order->status, ['delivered', 'cancelled']))
            <div class="refresh-indicator">
                <span class="spinner"></span>
                This page refreshes automatically every 10 seconds
            </div>
        @endif

    </div>
@endsection

@if(!in_array($order->status, ['delivered', 'cancelled']))
    @push('scripts')
    <script>
        // Auto-refresh every 10 seconds
        setTimeout(() => location.reload(), 10000);
    </script>
    @endpush
@endif