<?php /** @var View $view */

use Application\Kernel\Session\Session;
use Application\Kernel\View\View;

$view->component('start') ?>
<h1>
    Add a new movie
</h1>

<form action="/admin/movies/create" method="post">
    <div>
        <input name="name" type="text"/>
    </div>
    <ul>
        <?php /** @var Session $session */
        if ($session->has('name')) { ?>
            <?php foreach ($session->getFlash('name') as $error) { ?>
                <li style="color: red"><?php echo $error ?></li>
            <?php } ?>
        <?php } ?>
    </ul>
    <div>
        <button>Add</button>
    </div>
</form>

<?php $view->component('end') ?>
