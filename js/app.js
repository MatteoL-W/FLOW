/* *******************************************************************************************************************************
**********************************************************************************************************************************
-------------------------------------------------------- ERREUR & INFO -----------------------------------------------------------
**********************************************************************************************************************************
******************************************************************************************************************************** */

$('#croix_erreur').click(() => {
    $('#erreur').hide();
});

$('#croix_info').click(() => {
    $('#info').hide();
});

/* *******************************************************************************************************************************
**********************************************************************************************************************************
-------------------------------------------------------- PROFIL -----------------------------------------------------------
**********************************************************************************************************************************
******************************************************************************************************************************** */

if ( window.location.href.includes("profil") == true ) {
    let profil1 = $('#profil1'),
        profil2 = $('#profil2'),
        fleche1 = $('#fleche'),
        fleche2 = $('#fleche2');

        fleche1.on('click', () => {
            /* KEYFRAMES */
            profil1.addClass('classMvtGauche');
            fleche1.addClass('classMvtGauche');
            fleche2.addClass('fleche2MvtGauche');

            if ($(window).width() > 700) {
                setTimeout(() => {
                    profil1.removeClass('classMvtGauche');
                    profil1.css({marginLeft : "calc(140px - 100vw)"});
    
                    fleche1.css({left: '50px'});
                    fleche1.removeClass('classMvtGauche');
    
                    fleche2.css({left: '9%'})
                    fleche2.removeClass('fleche2MvtGauche');
    
                },950);
            } else {
                setTimeout(() => {
                    profil1.removeClass('classMvtGauche');
                    profil1.css({marginLeft : "calc(-100vw)"});
    
                    fleche1.css({left: '50px'});
                    fleche1.removeClass('classMvtGauche');
    
                    fleche2.css({left: '9%'})
                    fleche2.removeClass('fleche2MvtGauche');
    
                },950);
            }
            
            

        });

        fleche2.on('click', () => {
            profil1.addClass('classMvtDroite');
            fleche1.addClass('flecheMvtDroite');
            fleche2.addClass('fleche2MvtDroite');
            
            setTimeout(() => {
                fleche1.css({left: '95%'})
                fleche1.removeClass('flecheMvtDroite');

                fleche2.css({left: 'calc(100vw + 3%)'});
                fleche2.removeClass('fleche2MvtDroite');

                profil1.removeClass('classMvtDroite');
                profil1.css({marginLeft : "0"});

            },950);

        });

        $('#galerie').on('click', () => {
            $('#image_post').trigger('click');
        });
    
        $('#img_music').on('click', () => {
            $('#son_post').trigger('click');
        });
    
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#display_image').css({'display':'block'});
                    $('#display_image').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#image_post").change(function(){
            $('#img_music').css({'display': 'none'});
            readURL(this);
        });
    
        $("#son_post").change(function(){
            let test = $('#son_post')[0].files[0]['name'];
            $("#display_son").html('<u>' + test + '</u> a bien été chargé.');
            $("#display_son").css({'display': 'block'});
            $('#galerie').css({'display': 'none'});
        });
}

/* *******************************************************************************************************************************
**********************************************************************************************************************************
------------------------------------------------------------ ACCUEIL -------------------------------------------------------------
**********************************************************************************************************************************
******************************************************************************************************************************** */

function chargerPosts(limit) {
    const req = new XMLHttpRequest();
    req.addEventListener("load", evt => {
        let data = req.responseText;
        document.getElementById('all-posts').innerHTML = data;
    });

    let url = "traitement/Taccueil.php?limit=" + limit ;
    req.open("GET", url);
    req.send();
}

if ( window.location.href.includes("accueil") == true ) {
    $('#galerie').on('click', () => {
        $('#image_post').trigger('click');
    });

    $('#img_music').on('click', () => {
        $('#son_post').trigger('click');
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            
            reader.onload = function (e) {
                $('#display_image').css({'display':'block'});
                $('#display_image').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#image_post").change(function(){
        $('#img_music').css({'display': 'none'});
        readURL(this);
    });

    $("#son_post").change(function(){
        let test = $('#son_post')[0].files[0]['name'];
        $("#display_son").html('<u>' + test + '</u> a bien été chargé.');
        $("#display_son").css({'display': 'block'});
        $('#galerie').css({'display': 'none'});
    });

    let cpt = 5;

    chargerPosts(cpt);
    cpt+= 5;

    let voirPlus = document.getElementById('accueil_vp');
    voirPlus.addEventListener('click', function() {
        chargerPosts(cpt);
        chargerLikes();
        cpt+=10;
    });
}

/* *******************************************************************************************************************************
**********************************************************************************************************************************
-------------------------------------------------------- MON COMPTE --------------------------------------------------------------
**********************************************************************************************************************************
******************************************************************************************************************************** */

if ( window.location.href.includes("monCompte") == true ) {

    $('#btnChangerAvatar').on('click',() => {
        $('#changerAvatar').trigger('click');
    });

    $('#btnChangerBanniere').on('click',() => {
        $('#changerBanniere').trigger('click');
    });

}

/* *******************************************************************************************************************************
**********************************************************************************************************************************
-------------------------------------------------------- INSCRIPTION -----------------------------------------------------------
**********************************************************************************************************************************
******************************************************************************************************************************** */

if ( window.location.href.includes("inscription") == true ) {
    document.getElementById('date').valueAsDate = new Date(2009, 12, 31);
}

/* *******************************************************************************************************************************
**********************************************************************************************************************************
----------------------------------------------------------- AMIS ----------------------------------------------------------------
**********************************************************************************************************************************
******************************************************************************************************************************** */

if ( window.location.href.includes("mesAmis") == true ) {
    let cpt = 5;
    
    function chargerAmis(limit) {
        const req = new XMLHttpRequest();
        req.addEventListener("load", evt => {
            let data = req.responseText;
            document.getElementById('amis_container').innerHTML = data;
        });

        let url = "traitement/Tafficher-amis.php?limit=" + limit ;
        req.open("GET", url);
        req.send();
    }

    chargerAmis(cpt);
    cpt+= 5;

    let voirPlusPost = document.getElementById('amis_vp');
    voirPlusPost.addEventListener('click', function() {

        chargerAmis(cpt);
        cpt+=5;

    });
}

/* *******************************************************************************************************************************
**********************************************************************************************************************************
-------------------------------------------------------- LIKES -----------------------------------------------------------
**********************************************************************************************************************************
******************************************************************************************************************************** */

    
$(document).ready(function() {
    chargerLikes();
});

function chargerLikes() {
    setTimeout(function() {
        $('.flex_compl_comm').on('click',".clickForLikes", function() {
            let hauteurScrolle = $(document).scrollTop();
            
            $('#displayLikes').css({'top': 'calc('+hauteurScrolle+'px + 10%)'});
    
            $('#displayLikes').show();
            let id = this.getAttribute('data-id');
    
            const req = new XMLHttpRequest();
            req.addEventListener("load", evt => {
                let data = req.responseText;
                document.getElementById('all-likes').innerHTML = data;
            });
    
            let url = "traitement/Tafficher-likes.php?idPost=" + id ;
            req.open("GET", url);
            req.send();
        });
    
        $('#croix_likes').on('click', function() {
            $('#displayLikes').hide();
        });

        $('.post_like').on('click', function() {
            let id = this.getAttribute('data-id');
            let idAuteur = this.getAttribute('data-idAuteur');


            const req = new XMLHttpRequest();
    
            let url = "traitement/Tlikepost.php?idPost="+id+"&idAuteur="+idAuteur;
            req.open("GET", url);
            req.send();

            location.reload();
        });

    }, 200);           
}



/*
let voirPlus = document.getElementById('accueil_vp');
    voirPlus.addEventListener('click', function() {
        chargerPosts(cpt);
        chargerLikes();
        cpt+=10;
    });*/