<div class="navi">
    <!-- list -->
    <ul class="list-unstyled menu">
        @foreach($categories as $cat)
            <li class="has_sub">
                <a href="{{ route('category', ['slug' => str_slug(trim($cat->name), '-'), 'id' => $cat->id ]) }}" style="background-color: #da1313; color: #fff">
                    {{ $cat->name }}
                </a>
                <ul class="list-unstyled">
                    @foreach($cat->subCat as $subCat)
                        @if (!$loop->first)
                        <li>
                            <a href="{{ route('category', ['slug' => str_slug(trim($subCat->name), '-'), 'id' => $subCat->id ]) }}" style="padding-left: 30px">
                                <i class="fa fa-minus"></i>{{ $subCat->name }}
                            </a>
                        </li>
                        @endif
                   @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
