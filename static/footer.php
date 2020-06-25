<div class="glossary_footer">
    <table class="footer_table">
        <tr>
            <?php
            $path = $_SERVER['REQUEST_URI'];
            $barepath = strtok($path, '?');
            if (strpos($path, 'admin') !== false) {
                $barepath = strtok($barepath, 'admin');
            }
            echo '<td><a href="' . $barepath . '" title="Aller à la page d&apos;accueil">Page d&apos;accueil</a></td>';
            echo '<td><a href="' . $barepath . '?page=about" title="Aller à la page &apos;À propos des glossaires Terminorel&apos;">À propos des glossaires</a></td>';
            echo '<td><a href="' . $barepath . '?page=help" title="Aller au mode d&apos;emploi des glossaires">Aide</a></td>';
            echo '<td><a href="' . $barepath . '?page=copyright" title="En savoir plus sur les droits d&apos;auteur associés aux glossaires">Droits d&apos;auteur</a></td>';
            echo '<td><a href="' . $barepath . '?page=contact" title="Nous écrire">Nous contacter</a></td>';
            ?>
        </tr>
    </table>
</div>