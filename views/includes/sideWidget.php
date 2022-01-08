<div class="card mb-2">
    <div class="card-header">Srilankan Statistics</div>
    <!--        <h4>Side Widget Well</h4>-->
    <!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>-->
    <div class="card-body">
        <h6>Local New Cases : <span class="text-warning" id="new-cases"></span></h6>
        <h6>Local New Deaths : <span class="text-danger" id="new-deaths"></span></h6>

    </div>
</div>

<script>
    $(document).ready(()=>{
        $.ajax({
            url: "https://www.hpb.health.gov.lk/api/get-current-statistical",
            method: "get",
            success: function (respose){
                $("#new-cases").text(respose.data.local_new_cases);
                $("#new-deaths").text(respose.data.local_new_deaths);
            }
        })
    })
</script>

<div class="card mb-2">
    <div class="card-header">World Statistics</div>
<!--        <h4>Side Widget Well</h4>-->
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>-->
    <div class="card-body">
    <iframe src="https://public.domo.com/cards/bWxVg" width="100%" height="600" marginheight="0" marginwidth="0" frameborder="0"></iframe>
    </div>
</div>