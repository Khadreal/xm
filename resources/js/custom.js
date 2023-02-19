$(document).ready(function () {
    let $startDate = $("#start_date"),
        $endDate = $("#end_date");

    $startDate.datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        onSelect: function(dateStr) {
            let d = $.datepicker.parseDate('yy-mm-dd', dateStr);
            d.setDate(d.getDate() + 1);

            $endDate.datepicker('setDate', d).datepicker('option', 'minDate', d);
        }
    });
    $endDate.datepicker({
        dateFormat: 'yy-mm-dd'
    });
});

let XM = function(){
    this.searchForm = document.querySelector('#search');

    if(this.searchForm) this.fetchData();
};

XM.prototype.fetchData = function () {
    let __this = this,
        searchButton = document.querySelector('.btn-search'),
        notf = document.querySelector('.error-bag');

    __this.searchForm.addEventListener('submit', function(e){
        e.preventDefault();
        searchButton.disabled = true;
        searchButton.innerHTML = 'Fetching the data....'
        fetch('/fetch-historical-data', {
            method: 'POST',
            body: new FormData(e.target)
        }).then(response => {
            if (response.ok) {
                return response.text();
            }

            return Promise.reject(response);
        }).then(html => {
            document.querySelector('#js-result-view').innerHTML = html
        }).catch(function (error) {
            if(error){
                error.json().then((json) => {
                    notf.innerHTML = ''
                    notf.classList.add('alert-danger')
                    notf.classList.add('alert')
                    json.errors.forEach(element =>
                        notf.innerHTML += '<li>' + element + '</li>'
                    );
                })
            }
        }).finally(() => (
            searchButton.innerHTML = 'Submit',
            searchButton.disabled = false
        ));
    })
};

document.addEventListener('DOMContentLoaded', function(){
    new XM();
})
