document.querySelectorAll('input[type="number"]').forEach(function(node) {
    node.addEventListener('change', function() {
        elt = document.getElementById(this.id.replace("input", "label"));
        elt.innerHTML = this.value;

        document.getElementById("total").innerHTML = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(
            total(),
        );
    })
});

function total() {
    var total = 0;
    let elements = document.querySelectorAll('input[type="number"]');
    for (let i = 0; i < elements.length; i++) {
        total += parseInt(elements[i].value) * parseInt(elements[i].getAttribute("data-price"))
    }

    return total;
}

function validateForm() {
    if (total() > 0) {
        return true;
    } else {
        alert("Vous devez sélectionner au moins un billet.");
        return false;
    }
}
