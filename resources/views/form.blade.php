<!DOCTYPE html>
<html>
<head>
    <title>Tax Calculator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div class="container vh-100 align-items-center">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col col-md-8 col-lg-7">
                <h3 class="text-center">Tax Calculator</h3>
                <div class="form-group my-3">
                    <label for="salary">Monthly Salary</label>
                    <input type="text" class="form-control" id="salary" placholder="Montly Salary" min="1" />
                </div>
                <div class="form-group my-3">
                    <label for="salary">Tax Relief</label>
                    <select class="form-control" id="status">
                        <option value="TK0">TK-0 / Single</option>
                        <option value="K0">K-0 / Married with no dependant</option>
                        <option value="K1">K-1 / Married with 1 dependant</option>
                        <option value="K2">K-2 / Married with 2 dependants</option>
                        <option value="K3">K-3 / Married with 3 dependants</option>
                    </select>
                </div>
                <div class="text-center mb-3">
                    <button class="btn btn-primary" id="calculate">Calculate</button>
                </div>
                <div class="form-group" id="result" style="display:none;">
                    <label for="salary">Annual Tax</label>
                    <input type="text" class="form-control" id="tax" disabled />
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js" integrity="sha512-3z5bMAV+N1OaSH+65z+E0YCCEzU8fycphTBaOWkvunH9EtfahAlcJqAVN2evyg0m7ipaACKoVk6S9H2mEewJWA==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $('#salary').number(true, 0);
    $('#calculate').click(function(){
        $('#result').hide('slow');
        var postUrl = "{{url('/')}}";
        var token = $('meta[name="csrf-token"]').attr('content');
        var salary = $('#salary').val();
        var status = $('#status').val();
        $.ajax({
            url:postUrl,
            data:{_token:token, salary:salary, status:status},
            success:function(data){
                $('#tax').val(data.tax);
                $('#tax').number(true, 0);
                $('#result').show('slow');
            }
        });
    });
});
</script>
</body>
</html>
