<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Categories</title>
</head>
<body>
    <h1>Categories</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('categories.create') }}">Add Category</a>
<!-- 
    <ul>
        @foreach($categories as $category)
            <li>
                <strong>{{ $category->name }}</strong>
                @if($category->children->isNotEmpty())
                    <ul>
                        @foreach($category->children as $child)
                            <li>{{ $child->name }}
                                @if($child->children->isNotEmpty())
                                    <ul>
                                        @foreach($child->children as $grandChild)
                                            <li>{{ $grandChild->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul> -->
 


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Subcategories</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if($category->children->isNotEmpty())
                                <ul class="list-unstyled">
                                    @foreach($category->children as $child)
                                        <li>
                                            {{ $child->name }}
                                            @if($child->children->isNotEmpty())
                                                <ul>
                                                    @foreach($child->children as $grandChild)
                                                        <li>{{ $grandChild->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                No subcategories
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
