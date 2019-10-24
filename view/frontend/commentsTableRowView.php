<tr>
    <td><?php echo $data['post_id']; ?></td>
    <td><?php echo $data['author']; ?></td>
    <td><?php echo $data['report']; ?></td>
    <td><?php echo $data['comment']; ?></td>
    <td>
        <a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" class="btn btn-danger">Effacer</a>
        <a href="index.php?action=validateComment&amp;id=<?= $data['id'] ?>" class="btn btn-info ml-2">Valider</a>

    </td>
</tr>