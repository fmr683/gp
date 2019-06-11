const domain = "http://localhost:8000/";


$("document").ready(function(){

    var localToken = getToken();
    
    demoUsers();

    if (localToken) {
        chartForm(localToken);
        showChart();
    } else {
        showLogin();
    }

    $("#logout").click(function() {
        removeToken();
        showLogin();
    })

    $("#login-form").submit(function() {

        $.post(domain + "v1/auth/login", $("#login-form").serialize())
        .done(function(data) {

            localStorage.setItem("token", data.token); // set the token
            chartForm (data.token)
            showChart();
            $("#error").html('');
        })
        .fail(function (data) {

            $("#error").html(loginErrors(data));
        });

        return false;
    })

});


// get demo users 
function demoUsers() {

    $.get(domain + "/users/list")
    .done(function(data) {

        $.each(data, function(key, val) {
            $("#sampleUsers").append("Email: " + val[0].email+ " <br/> Password: 12345");
            return true;
        });
    })
    .fail(function () {

        alert("No User data found in the db")
    });

}


// login errors
function loginErrors(error) {

    if (error.error !== undefined) return error.error;

    if (error.responseJSON.error !== undefined) return error.responseJSON.error;

    if (error.responseJSON.email && error.responseJSON.email[0] !== undefined) return error.responseJSON.email[0];

    if (error.responseJSON.password && error.responseJSON.password[0] !== undefined) return error.responseJSON.password[0];

}

// Get the token from local storage
function getToken() {
    return localStorage.getItem("token");
}

// Removed the token from local storage
function removeToken() {
    localStorage.removeItem("token");
}

// Show the chart
function showChart() {
    $("#login-wrapper").hide();
    $("#chart-wrapper").show();
}

// Show the login form
function showLogin () {
    $("#login-wrapper").show();
    $("#chart-wrapper").hide();
}

// chart data
function chartForm (token) {

    $.ajax({
        type: 'GET',
        url: domain + 'v1/user-flow/flow/count/weekly',
        dataType: "json",
        headers: {
            "Authorization": "Bearer " + token
        }
    }).done(function (data) {
        // console.log(data);
        lineChart(data)
    })
    .fail(function () {
        window.localStorage = '/' // refresh auto looks like token is epxired
    });
}

function lineChart(series) {

    // HighCharts
    Highcharts.chart('chart', {

        title: {
            text: 'Weekly Retention Curve'
        },

        xAxis: {
			categories:
				['0', '20', '40', '50', '70', '90', '99', '100']
		},
        yAxis: {
            title: {
                text: 'Percentage of Users'
            },
            lables: {
                format: '{value} %'
            },
            min: '0',
            max: '100'
        },
        
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        ...series,

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
}