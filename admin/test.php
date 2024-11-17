<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocomplete Example</title>

 <style>
 
 @charset "utf-8";
#suggestions-container {
    position: absolute;
    width: 200px;
    max-height: 150px;
    overflow-y: auto;
    border: 1px solid #ccc;
    display: none;
}

.suggestion {
    padding: 8px;
    cursor: pointer;
}

.suggestion:hover {
    background-color: #f0f0f0;
}
/* CSS Document */

</style>
</head>
<body>

   <label for="search">Search:</label>
    <input type="text" id="search" autocomplete="off">
    <div id="suggestions-container"></div>
</body>

<script language="javascript">

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const suggestionsContainer = document.getElementById('suggestions-container');

    searchInput.addEventListener('input', function () {
        const query = this.value;

        if (query.length > 0) {
            fetch(`search.php?query=${query}`)
                .then(response => response.json())
                .then(data => showSuggestions(data));
        } else {
            suggestionsContainer.innerHTML = '';
            suggestionsContainer.style.display = 'none';
        }
    });

    function showSuggestions(suggestions) {
        suggestionsContainer.innerHTML = '';
        suggestions.forEach(suggestion => {
            const suggestionElement = document.createElement('div');
            suggestionElement.classList.add('suggestion');
            suggestionElement.textContent = suggestion;

            suggestionElement.addEventListener('click', function () {
                searchInput.value = suggestion;
                suggestionsContainer.style.display = 'none';
            });

            suggestionsContainer.appendChild(suggestionElement);
        });

        suggestionsContainer.style.display = 'block';
    }
});
// JavaScript Document
</script>
</html>