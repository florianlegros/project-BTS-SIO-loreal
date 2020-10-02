var app = {

    initialize: function() {

        $(".Ajouter").on('click', this.addPanier)
        $(".Enlever").on('click', this.rmPanier)

    },

    addPanier: function() {
        idArticle = $(this).data('id');
        Panier = localStorage.getItem("Panier");
        Panier = JSON.parse(Panier);
        for (let i = 0; i < Panier.length; i++) {
            if (Panier[i].id == idArticle) {
                Panier[i].qte += 1
                localStorage.setItem("Panier", JSON.stringify(Panier));
                document.cookie = "panier=" + JSON.stringify(Panier);
                location.reload();
                return false;
            }
        }
        if (Panier.length == 0) {

            article = [{
                "id": idArticle,
                "qte": 1,
            }, ];

            localStorage.setItem("Panier", JSON.stringify(article));
            document.cookie = "panier=" + JSON.stringify(article);

        } else {
            article = [{
                "id": idArticle,
                "qte": 1,
            }, ];

            Panier = Panier.concat(article);

            localStorage.setItem("Panier", JSON.stringify(Panier));
            document.cookie = "panier=" + JSON.stringify(Panier);
        }
        location.reload();
    },

    rmPanier: function() {
        idArticle = $(this).data('id');
        Panier = localStorage.getItem("Panier");
        Panier = JSON.parse(Panier);
        for (let i = 0; i < Panier.length; i++) {
            if (Panier[i].id == idArticle) {
                if (Panier[i].qte == 1) {
                    Panier.splice(i, 1)
                    localStorage.setItem("Panier", JSON.stringify(Panier));
                    document.cookie = "panier=" + JSON.stringify(Panier);
                    location.reload();
                    return false;
                }
                Panier[i].qte -= 1
                localStorage.setItem("Panier", JSON.stringify(Panier));
                document.cookie = "panier=" + JSON.stringify(Panier);
                location.reload();
                return false;
            }
        }

        document.cookie = "panier=" + JSON.stringify(Panier);
        location.reload();
    },


};

if (localStorage.getItem('Panier') === null) localStorage.setItem("Panier", "[]");


app.initialize();