<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
@yield('js')
<script src="{{asset('site/js/libs.min.js')}}"></script>
<!-- scripts-->
<script src="{{asset('site/js/common.min.js')}}"></script>
<script>
    $(document).ready(function(){

        $('input[name=option-select]').click(function(){
            $(".mfs").hide();
            $(".bank").hide();
            if(document.getElementById("mfs").checked==true)
            {
                console.log('MFS');
                $(".mfs").show();
            }

            if(document.getElementById("Bank").checked==true)
            {
                console.log('Bank');
                $(".bank").show();
            }
        });

        
    });
</script>