<!-- Vendor JS Files -->
<script src="{{asset ('user/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset ('user/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset ('user/assets/vendor/chart.js/chart.umd.js')}}"></script>
<script src="{{asset ('user/assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset ('user/assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{asset ('user/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset ('user/assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset ('user/assets/vendor/php-email-form/validate.js')}}"></script>

<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>

<script type="text/javascript">
    $(function () {
        let dateInterval = getQueryParameter('date_filter');
        let start = moment().startOf('isoWeek');
        let end = moment().endOf('isoWeek');
        if (dateInterval) {
            dateInterval = dateInterval.split(' - ');
            start = dateInterval[0];
            end = dateInterval[1];
        }
        $('#date_filter').daterangepicker({
            "showDropdowns": true,
            "showWeekNumbers": true,
            "alwaysShowCalendars": true,
            startDate: start,
            endDate: end,
            locale: {
                format: 'YYYY-MM-DD',
                firstDay: 1,
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
            }
        });
    });
    function getQueryParameter(name) {
        const url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
</script>

<!-- Template Main JS File -->
<script src="{{asset ('user/assets/js/main.js')}}"></script>