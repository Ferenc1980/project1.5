$("document").ready(function(){
    //új sor hozzáadása:
    $("#add").click(function(){
        $("#tbl").append('<tr><td><input class="form-control input-datum" type="date" name="datum[]" ></td><td><button type="button" class="btn btn-danger del">Törlés</button></td></tr>');
    });
    //törlés a bevezető formnál:
    $(document).on('click','.del',function(){
                $(this).closest("tr").remove();  
    });
    //mentés:
    $("#submit").click(function(){
        $.ajax({
            url:"unnepek/save.php",
            type:"post",
            data:$("#frm").serialize(),
            success:function(data){
                $("p").html(data);
                $("#frm")[0].reset();
                window.location.reload()
            }
        });
 
    });
//ellenőrzés:
$(document).on('change','.input-datum',function(){
        let datum=this.value
        let obj=this
        console.log('datum:'+datum)
        $.ajax({
            url:"unnepek/ellenor.php",
            type:"post",
            data:'datum='+datum,
            success:function(data){
                console.log('data:'+data)
                if(data=='1'){
                    console.log('van már ilyen')
                    $(obj).css('color','red')
                    //$(obj).val("");
                }else{
                    console.log('ez jó')
                    $(obj).css('color','green')
                }
            }
        });
    })

    //ev-hó kiválasztása után az adatok szűrése:
    $('#evho').on('change',function(){
    let evho=this.value;
    console.log('evho='+evho)
    $.ajax({
        url:"unnepek/szures.php",
        type:"post",
        data:'datum='+evho,
        success:function(data){
            console.log('data:'+data)
            $('#tbl-body').html(data)
           
        }
    });
})
   
});

