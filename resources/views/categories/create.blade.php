<!-- resources/views/category/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Create Category</h1>

    <form action="{{ route('category.store') }}" method="POST">
        @csrf

        <div id="category-container">
            <label for="category">Select Category:</label>
            <select id="category" name="category[]" onchange="loadSubCategories(this)">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Submit</button>
    </form>

    <!-- <script>
        function loadSubCategories(selectedElement) {
            let parentId = selectedElement.value;
            let container = document.getElementById('category-container');

            if (parentId) {
                // Create new select element for subcategories
                let subCategorySelect = document.createElement('select');
                subCategorySelect.name = 'category[]';
                subCategorySelect.setAttribute('onchange', 'loadSubCategories(this)');
                console.log(this.);
                subCategorySelect.innerHTML = `<option value="">Select a subcategory</option>`;

                fetch(`/get-subcategories/${parentId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.subcategories.forEach(subcategory => {
                            let option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subCategorySelect.appendChild(option);
                        });
                        container.appendChild(subCategorySelect);
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            }
        }
    </script> -->
    <script>
        function loadSubCategories(selectedElement) {
            let parentId = selectedElement.value;
            let container = document.getElementById('category-container');

            let nextSibling = selectedElement.nextElementSibling;
            while (nextSibling && nextSibling.tagName === 'SELECT') {
                container.removeChild(nextSibling);
                nextSibling = selectedElement.nextElementSibling;
            }

            if (parentId) {
                let subCategorySelect = document.createElement('select');
                subCategorySelect.name = 'category[]';
                subCategorySelect.setAttribute('onchange', 'loadSubCategories(this)');
                subCategorySelect.innerHTML = `<option value="">Select a subcategory</option>`;

                fetch(`/get-subcategories/${parentId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.subcategories.forEach(subcategory => {
                            let option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subCategorySelect.appendChild(option);
                        });
                        container.appendChild(subCategorySelect);
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            }
        }
    </script>


</body>
</html>
