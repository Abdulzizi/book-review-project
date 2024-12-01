@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Books Review</h1>

    {{-- Search by name --}}
    <form method="GET" action="{{ route('books.index') }}" class="flex items-center mb-4 space-x-2">
        <input type="hidden" name="filter" value="{{ request('filter') }}">
        <input type="text" name="title" placeholder="Search By Title..." value="{{ request('title') }}"
            class="input h-10">
        <button type="submit" class="btn h-10">Search</button>
        <a href="{{ route('books.index') }}" class="btn h-10">Clear</a>
    </form>

    {{-- Filtering by date --}}

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_6_month' => 'Popular Last 6 Months',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_last_6_month' => 'Highest Rated Last 6 Months',
            ];
        @endphp

        @foreach ($filters as $key => $label)
            <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"
                class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">{{ $label }}</a>
        @endforeach
    </div>

    {{-- Book list --}}
    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">by {{ $book->author }}</span>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <span
                                    class="text-s font-semibold text-yellow-500">{{ number_format($book->reviews_avg_rating, 1) }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500 ml-1"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>

    <!-- Pagination -->
    @if ($books->count())
        <nav class="mt-4">
            {{ $books->links() }}
        </nav>

        <div class="flex items-center justify-center min-h-[50px]">
            <p class="text-center text-gray-500">
                Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $totalBooks }} books
            </p>
        </div>
    @endif
@endsection
