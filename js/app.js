// si on se trouve sur la page d'un profil
if ( window.location.href.includes("?action=profil") == true ) {
    let profil1 = $('#profil1'),
        profil2 = $('#profil2'),
        fleche1 = $('#fleche'),
        fleche2 = $('#fleche2');

        fleche1.on('click', () => {
            /* KEYFRAMES */
            profil1.addClass('classMvtGauche');
            fleche1.addClass('classMvtGauche');
            fleche2.addClass('fleche2MvtGauche');
            
            setTimeout(() => {
                profil1.removeClass('classMvtGauche');
                profil1.css({marginLeft : "calc(140px - 100vw)"});

                fleche1.css({left: '50px'});
                fleche1.removeClass('classMvtGauche');

                fleche2.css({left: '9%'})
                fleche2.removeClass('fleche2MvtGauche');

            },950);
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
}

$('#croix_erreur').click(() => {
    $('#erreur').hide();
});

$('#croix_info').click(() => {
    $('#info').hide();
});

if ( window.location.href.includes("?action=monCompte") == true ) {

    $('#btnChangerAvatar').on('click',() => {
        $('#changerAvatar').trigger('click');
        console.log("$('#btnChangerAvatar').value");
    });

    $('#btnChangerBanniere').on('click',() => {
        $('#changerBanniere').trigger('click');
    });

}


/*
profil1.css({
    "transform" : "translateX(-100vw)",
})


$('#fleche2').on('click', () => {
    profil1.css({"transform" : "translateX(100vw)"});
});*/

