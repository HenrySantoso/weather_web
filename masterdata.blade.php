<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Store</title>
    <!-- CSS for DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables library -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        function getBook() {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'https://localhost:7276/api/Books', true);
            xhr.send();
            xhr.onload = function() {
                if (xhr.status != 200 && xhr.status != 201) {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                } else {
                    let table = document.getElementById("outputTable").getElementsByTagName('tbody')[0];
                    let data = JSON.parse(xhr.responseText);
                    table.innerHTML = ''; // Clear the table before appending new data
                    data.forEach(function(item) {
                        var row = document.createElement("tr");

                        var id = document.createElement("td");
                        id.textContent = item.Id;
                        row.appendChild(id);

                        var name = document.createElement("td");
                        name.textContent = item.BookName;
                        row.appendChild(name);

                        var price = document.createElement("td");
                        price.textContent = item.Price;
                        row.appendChild(price);

                        var category = document.createElement("td");
                        category.textContent = item.Category;
                        row.appendChild(category);

                        var author = document.createElement("td");
                        author.textContent = item.Author;
                        row.appendChild(author);

                        var editor = document.createElement("td");
                        editor.textContent = item.Editor;
                        row.appendChild(editor);

                        var address = document.createElement("td");
                        address.textContent = item.Address;
                        row.appendChild(address);

                        // Edit button
                        var editButton = document.createElement("button");
                        editButton.textContent = "Edit";
                        editButton.onclick = function() {
                            populateEditForm(item);
                        };
                        var editCell = document.createElement("td");
                        editCell.appendChild(editButton);
                        row.appendChild(editCell);

                        // Delete button
                        var deleteButton = document.createElement("button");
                        deleteButton.textContent = "Delete";
                        deleteButton.onclick = function() {
                            deleteBook(item.Id, row);
                        };
                        var deleteCell = document.createElement("td");
                        deleteCell.appendChild(deleteButton);
                        row.appendChild(deleteCell);

                        table.appendChild(row);
                    });
                    $('#outputTable').DataTable();
                }
            };
        }

        function deleteBook(bookId, row) {
            console.log(`Deleting book with ID: ${bookId}`);
            let xhr = new XMLHttpRequest();
            xhr.open('DELETE', `https://localhost:7276/api/Books/${bookId}`, true);
            xhr.send();
            xhr.onload = function() {
                if (xhr.status == 200 || xhr.status == 204) {
                    console.log(`Book with ID: ${bookId} deleted successfully`);
                    row.remove();
                } else {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                    console.error(`Failed to delete book with ID: ${bookId}. Status: ${xhr.status}, StatusText: ${xhr.statusText}`);
                }
            };
            xhr.onerror = function() {
                alert('Request failed');
                console.error('Request failed');
            };
        }

        function createBook() {
            let book = {
                BookName: document.getElementById('bookName').value,
                Price: document.getElementById('bookPrice').value,
                Category: document.getElementById('bookCategory').value,
                Author: document.getElementById('bookAuthor').value,
                Editor: document.getElementById('bookEditor').value,
                Address: document.getElementById('bookAddress').value
            };

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'https://localhost:7276/api/Books', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(book));
            xhr.onload = function() {
                if (xhr.status == 200 || xhr.status == 201) {
                    console.log('Book created successfully');
                    getBook(); 
                    document.getElementById('createBookForm').reset(); 
                } else {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                    console.error(`Failed to create book. Status: ${xhr.status}, StatusText: ${xhr.statusText}`);
                }
            };
            xhr.onerror = function() {
                alert('Request failed');
                console.error('Request failed');
            };
        }

        function populateEditForm(book) {
            document.getElementById('editBookId').value = book.Id;
            document.getElementById('editBookName').value = book.BookName;
            document.getElementById('editBookPrice').value = book.Price;
            document.getElementById('editBookCategory').value = book.Category;
            document.getElementById('editBookAuthor').value = book.Author;
            document.getElementById('editBookEditor').value = book.Editor;
            document.getElementById('editBookAddress').value = book.Address;
            document.getElementById('editBookForm').style.display = 'block';
        }

        function updateBook() {
            let bookId = document.getElementById('editBookId').value;
            let book = {
                Id: bookId,
                BookName: document.getElementById('editBookName').value,
                Price: document.getElementById('editBookPrice').value,
                Category: document.getElementById('editBookCategory').value,
                Author: document.getElementById('editBookAuthor').value,
                Editor: document.getElementById('editBookEditor').value,
                Address: document.getElementById('editBookAddress').value
            };

            let xhr = new XMLHttpRequest();
            xhr.open('PUT', `https://localhost:7276/api/Books/${bookId}`, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(book));
            xhr.onload = function() {
                if (xhr.status == 200 || xhr.status == 204) {
                    console.log('Book updated successfully');
                    getBook(); 
                    document.getElementById('editBookForm').reset(); 
                    document.getElementById('editBookForm').style.display = 'none'; 
                } else {
                    alert(`Error ${xhr.status}: ${xhr.statusText}`);
                    console.error(`Failed to update book. Status: ${xhr.status}, StatusText: ${xhr.statusText}`);
                }
            };
            xhr.onerror = function() {
                alert('Request gagal');
                console.error('Request gagal');
            };
        }

        window.onload = getBook;
    </script>
</head>
<body>
    <h2>Create a New Book</h2>
    <form id="createBookForm" onsubmit="createBook(); return false;">
        <label for="bookName">Book Name:</label><br>
        <input type="text" id="bookName" name="bookName" required><br>
        <label for="bookPrice">Price:</label><br>
        <input type="text" id="bookPrice" name="bookPrice" required><br>
        <label for="bookCategory">Category:</label><br>
        <input type="text" id="bookCategory" name="bookCategory" required><br>
        <label for="bookAuthor">Author:</label><br>
        <input type="text" id="bookAuthor" name="bookAuthor" required><br>
        <label for="bookEditor">Editor:</label><br>
        <input type="text" id="bookEditor" name="bookEditor" required><br>
        <label for="bookAddress">Address:</label><br>
        <input type="text" id="bookAddress" name="bookAddress" required><br><br>
        <input type="submit" value="Create Book">
    </form>

    <h2>Book List</h2>
    <table id="outputTable" class="display" border="1" align="center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Book Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Author</th>
                <th>Editor</th>
                <th>Address</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be dynamically added here -->
        </tbody>
    </table>

    <h2>Edit Book</h2>
    <form id="editBookForm" onsubmit="updateBook(); return false;" style="display:none;">
        <input type="hidden" id="editBookId" name="editBookId">
        <label for="editBookName">Book Name:</label><br>
        <input type="text" id="editBookName" name="editBookName" required><br>
        <label for="editBookPrice">Price:</label><br>
        <input type="text" id="editBookPrice" name="editBookPrice" required><br>
        <label for="editBookCategory">Category:</label><br>
        <input type="text" id="editBookCategory" name="editBookCategory" required><br>
        <label for="editBookAuthor">Author:</label><br>
        <input type="text" id="editBookAuthor" name="editBookAuthor" required><br>
        <label for="editBookEditor">Editor:</label><br>
        <input type="text" id="editBookEditor" name="editBookEditor" required><br>
        <label for="editBookAddress">Address:</label><br>
        <input type="text" id="editBookAddress" name="editBookAddress" required><br><br>
        <input type="submit" value="Update Book">
    </form>
</body>
</html>
