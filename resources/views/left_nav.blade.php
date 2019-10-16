<div class="navi">
    <!-- list -->
    <ul class="list-unstyled menu">
        @foreach($categories as $cat)
            <li class="has_sub">
                <a href="{{ route('category', ['slug' => str_slug(trim($cat->name), '-'), 'id' => $cat->id ]) }}">
                    {{ $cat->name }}
                </a>
                <ul class="list-unstyled">
                    @foreach($cat->subCat as $subCat)
                        <li>
                            <a href="{{ route('category', ['slug' => str_slug(trim($cat->name), '-'), 'id' => $cat->id ]) }}" style="padding-left: 30px">
                                <i class="fa fa-minus"></i>{{ $subCat->name }}
                            </a>
                        </li>
                   @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
