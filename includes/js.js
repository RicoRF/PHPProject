
function updateSelectedCrust() {

      var selectedValue = document.getElementById('crustSelect').value;
	  
      document.getElementById('selectedCrust').innerText = selectedValue;
    }
	
function updateSelectedSize() {

      var selectedValue = document.getElementById('sizeSelect').value;

      document.getElementById('selectedSize').innerText = selectedValue;
    }
	
    
function updateSelectedToppings() {
	// Get all checked checkboxes
	var checkboxes = document.querySelectorAll('input[name="toppings[]"]:checked');
	
	// Get the container for selected toppings
	var selectedToppingsContainer = document.getElementById('selectedToppings');
	
	// Get the container for the subtotal
	var selectedSubtotalContainer = document.getElementById('selectedSubtotal');

	// Extract the values and names of selected toppings
	var selectedToppings = Array.from(checkboxes).map(function (checkbox) {
		var labelElement = checkbox.nextElementSibling;
		if (labelElement) {
			var labelText = labelElement.textContent.trim();
			// Split at the first space and keep only the part before it
			return labelText.split(' ')[0];
		}
		return '';
	});

	// Extract the prices of selected toppings
	var selectedPrices = Array.from(checkboxes).map(function (checkbox) {
		var labelElement = checkbox.nextElementSibling;
		if (labelElement) {
			var labelText = labelElement.textContent.trim();
			// Extract the price after the dollar sign
			return parseFloat(labelText.split('$')[1]);
		}
		return 0;
	});

	// Calculate the sum of selected prices
	var subtotal = selectedPrices.reduce(function (sum, price) {
		return sum + price;
	}, 0);

	// Update the content of the toppings container with the list
	var listItems = selectedToppings.map(function (topping) {
		return '<li>' + topping + '</li>';
	});
	selectedToppingsContainer.innerHTML = '<ul>' + listItems.join('') + '</ul>';

	// Get the quantity selected value
	var quantity = document.getElementById("quantity").value;

	// Convert the quantity value to a number (assuming it's a string)
	quantity = parseInt(quantity, 10);

	subtotal = subtotal * quantity;

	// Update the content of the subtotal container
	selectedSubtotalContainer.textContent = '$' + subtotal.toFixed(2);
}
/*
async function submitPizzaAddToCartForm(event) {
    event.preventDefault(); // Prevent the default form submission

    // Perform Ajax request
    $.ajax({
        type: "POST",
        url: "add_to_cart.php",
        data: $("#build_pizza_form").serialize(), // Serialize form data
        success: function (response) {
            console.log('Success Response:', response);
            if (response == "1") {
                $("#result").text("Pizza added to the cart.");
            } else {
                $("#result").text("Pizza couldn't be added to the cart. Response: " + response);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error Response:', jqXHR, textStatus, errorThrown);
            $("#result").text("An error occurred.");
        }
    });
}
*/