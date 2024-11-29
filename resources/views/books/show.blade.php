@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Book Information Section -->
        @php
            // dd($book);
        @endphp
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800">{{ $book->title }}</h1>
            <p class="text-lg text-slate-600 mt-1">by <span class="font-medium">{{ $book->author }}</span></p>

            <div class="flex items-center mt-4 space-x-1">
                <div class="flex items-center">
                    <span
                        class="text-xl font-semibold text-yellow-500">{{ number_format($book->reviews_avg_rating, 1) }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 ml-1" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                    </svg>
                </div>
                <p class="text-sm text-slate-500">
                    {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                </p>
            </div>

            <div class=" mt-2">
                <a href="{{ route('books.index') }}" class="reset-link">Back</a>
            </div>
        </div>

        <!-- Reviews Section -->
        <div>
            <h2 class="text-2xl font-semibold text-slate-700 mb-4">Reviews</h2>
            <ul class="space-y-6">
                @forelse ($book->reviews as $review)
                    <li class="p-4 bg-white rounded-lg shadow-md">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-yellow-500">{{ $review->rating }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500 ml-1"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </div>
                            <span class="text-xs text-slate-500">
                                {{ $review->created_at->format('M j, Y') }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-600">{{ $review->review }}</p>
                    </li>
                @empty
                    <li class="p-6 bg-white rounded-lg shadow-md text-center">
                        <p class="text-slate-500">No reviews yet</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
