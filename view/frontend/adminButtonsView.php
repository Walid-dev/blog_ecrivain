<a href="index.php?action=edit&amp;id=<?= $data['id'] . "#editPostContainer" ?>" class="btn admin_btn mr-1">Editer</a>
<a href="index.php?action=addArticle#addPostContainer" class="btn admin_btn" type="submit">Ajouter article</a><br>
<a type="button" class="btn admin_btn mt-2" data-toggle="modal" data-target="#exampleModalCenter">
    Supprimer article
</a>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="deleteModalContent" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Supprimer article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>L'article est sur le point d'etre définitivement supprimer.<br>Confirmer la suppression ?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <a href="index.php?action=delete&amp;id=<?= $data['id'] ?>" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>