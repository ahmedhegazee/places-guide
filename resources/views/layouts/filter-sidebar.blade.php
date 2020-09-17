<div class="col-md-3 col-sm-12">
    <ul class="subcategories mb-4">
        {{-- <a href="{{ route('workads')}}"> --}}
        {{-- <a href="{{ route($route)}}"> --}}
        <a href="{{ $route}}">
            <li class="d-flex justify-content-between">
                <div>
                    {{-- <span>{{ __('pages.All Jobs') }}</span> --}}
                    <span>{{ $title}}</span>
                    <span class="count">({{ $count }})</span>
                </div><i class="fas fa-chevron-left"></i>
            </li>
        </a>
        @forelse ($categories as $category)
        <a href="{{ $route.'?cat='.$category->id }}">
            <li class="d-flex justify-content-between">
                <div><span>{{ $category->name }}</span>
                    @if (!is_null($category->places_count))
                    <span class="count">({{ $category->places_count }})</span>
                    @endif
                    @if (!is_null($category->ads_count))
                    <span class="count">({{ $category->ads_count }})</span>
                    @endif
                    @if (!is_null($category->accepted_places_count))
                    <span class="count">({{ $category->accepted_places_count }})</span>
                    @endif
                    {{-- @if ()

                                        @endif --}}
                </div><i class="fas fa-chevron-left"></i>
            </li>
        </a>
        @empty

        @endforelse
    </ul>
    <form action="{{ $route }}">
        <div class="filter mb-4">
            <h4 class="text-center filter-header">{{ __('pages.Filter') }}</h4>
            {!!Form::select('govern',$governs,null,array('class'=>'
            multiple-select','id'=>'govern','onchange'=>'getCities()','placeholder'=>'اختر
            المحافظة'))!!}
            <select class="multiple-select last-select" id="city" name="city">
                <option selected>اختر المدينة</option>
            </select>
            <input type="hidden" name="cat" value="{{ request()->cat }}">
        </div>
        <button class="btn btn-success filter-button" type="submit">{{ __('pages.Filter') }}</button>
        {{-- Button --}}
    </form>
</div>
