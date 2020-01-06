    var navH = $(".navh").height();

    $("#top--img").css({
        marginTop:-navH,
    });
    
    $("#megaMenu").css({
        top:navH,
    });
    
    $(window).bind("scroll", function() {
        if(navH<$("#nav").offset().top){
            $("#nav").css({
                backgroundColor:" #13131f",
            });

        }else{
                
                $("#nav").css({
                        backgroundColor: "#13131f00",
                });
        }
    });
    
    $(".nav--wrapper").hover(
        function(){
            $("#nav").css({
                backgroundColor: "#13131f",
            });
        },
        function(){
             $("#nav").css({
                backgroundColor: "#13131f00",
            });
        }
        );
    
    // mega-menuのhover
    //new
    $(".nav--li--new,.nav--mega--new").hover(
        function(){
            $(".nav--mega--new").css({
                height:200,
                display:"block",
            });
        },
        function(){
             $(".nav--mega--new").css({
                height:0,
                display:"none",
            });
        }
    );
    
    //acc
    $(".nav--li--acc,.nav--mega--acc").hover(
        function(){
            $(".nav--mega--acc").css({
                height:200,
                display:"block",
            });
        },
        function(){
             $(".nav--mega--acc").css({
                height:0,
                display:"none",
            });
        }
    );
    
    //table
    $(".nav--li--table,.nav--mega--table").hover(
        function(){
            $(".nav--mega--table").css({
                height:200,
                display:"block",
            });
        },
        function(){
             $(".nav--mega--table").css({
                height:0,
                display:"none",
            });
        }
    );
    
    //interior
    $(".nav--li--interior,.nav--mega--interior").hover(
        function(){
            $(".nav--mega--interior").css({
                height:200,
                display:"block",
            });
        },
        function(){
             $(".nav--mega--interior").css({
                height:0,
                display:"none",
            });
        }
    );
    
    //fashion
    $(".nav--li--fashion,.nav--mega--fashion").hover(
        function(){
            $(".nav--mega--fashion").css({
                height:200,
                display:"block",
            });
        },
        function(){
             $(".nav--mega--fashion").css({
                height:0,
                display:"none",
            });
        }
    );
    
    //food
    $(".nav--li--food,.nav--mega--food").hover(
        function(){
            $(".nav--mega--food").css({
                height:200,
                display:"block",
            });
        },
        function(){
             $(".nav--mega--food").css({
                height:0,
                display:"none",
            });
        }
    );    
    
    
    //slick
    $('.slider').slick({
    autoplay:true,
    autoplaySpeed:4000,
    dots:false,
    arrows:false,
    variableWidth: true,
    slidesToShow:5,
    touchMove:true,
    responsive:[
        {
            breakpoint: 1024,
            settings:{
                slidesToShow:3,
            }
        },
        {
            breakpoint: 768,
            settings:{
                slidesToShow:2,
            }
        },
        {
            breakpoint: 480,
            settings:{
                slidesToShow:1,
            }
        },
    ]
});



    
    $(".tip1").css({
        height:$(window).width()*35/100,
    });

    // setInterval(function(){
    //     navTop=$("#nav").offset().top;
    //     console.log(navTop);
    // },500)
    
    window.onload=function(){
        console.log();

    }