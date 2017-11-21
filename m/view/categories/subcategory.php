<div class="container masterhead">
    <div class="demo-headline">
        <h1 class="demo-logo"><?= $subcategory->title; ?> 
            <small><?= ($services) ? 'Ajustez le tri des experts :' : 'Aucun expert dans cette catégorie.'; ?></small>
        </h1>
        <div class="search-filters row text-center">
            <form class="form-inline padding-bottom-1" action="<?= $_SERVER['SCRIPT_URI']; ?>" method="post">
                <select name="sort">
                    <option value="callCount"<?php if ($this->Session->read('sortBy') == 'callCount') echo ' selected="selected"'; ?>>Les plus consultés</option>
                    <option value="rateCount"<?php if ($this->Session->read('sortBy') == 'rateCount') echo ' selected="selected"'; ?>>Les mieux notés</option>
                    <option value="id"<?php if ($this->Session->read('sortBy') == 'id') echo ' selected="selected"'; ?>>Les nouveaux</option>
                </select>
            </form>
        </div>
    </div>
</div>
<script>
        $(function() {
            global_nre = setInterval(function() {

                $.ajax({
                    type: "POST",
                    url: "/services/occupe_view_all",
                    data: {servicesid: servicesid},
                    success: function(s_html) {
                        var message = JSON.parse(s_html);
                        $(".call_button").css("display", "none");

                        for (status in message)
                        {
                            if (message[status] == 1)
                            {
                                $(".call_button_ok_" + status).css("display", "");
                            }
                            else {
                                if (message[status] == 0)
                                {
                                    $(".call_button_indisponible_" + status).css("display", "");
                                }
                                else
                                {
                                    $(".call_button_occupe_" + status).css("display", "");
                                }
                            }
                        }
                    },
                    error: function(e_html) {
                        e_message = $.trim(e_html);
                        console.log("error" + e_message);
                    }, });
            }, 2000);
        });

    </script>
<div class="container grid">
    <div class="row">
        <?php foreach ($services as $k => $v): ?><?php $v = current($v); ?>
            <div class="expert expert-grid span3 text-center">
                <a class="expert-thumbnail" href="<?= Router::url('services/view/cat:' . $v->category . '/subcat:' . $v->subcategory . '/' . $v->url); ?>"><img class="rounded" style="margin-bottom:10px;" src="<?= IMAGE; ?>services/<?= $v->img; ?>" alt="" /></a>
                <div class="expert-main-infos">
                    <h3 class="expert-title"><?= ($v->username == '') ? $v->user->first_name . ' ' . $v->user->last_name : utf8_decode($v->username); ?></h3>
                    <h6 class="expert-subtitle"><?= $v->title; ?></h6>
                </div>
                <div class="expert-stats">
                    <small>
                        <span class="label"><?= str_replace('.00', '', $v->rating); ?></span> 
                        <span class="label"><?= $v->callCount; ?><i class="icon-phone"></i></span>
                        <?php if ($v->promoBienvenue): ?>
                            <span class="labelpromo"><?= $v->promoBienvenue; ?></span>
                        <?php else: ?>
                            <span class="label"><?= number_format($v->cost_per_minute, 2); ?> €/min</span>
                        <?php endif; ?>
                    </small>
                </div>
                <a class="btn btn-info tiny" href="<?= Router::url('services/view/cat:' . $v->category . '/subcat:' . $v->subcategory . '/' . $v->url); ?>">Voir sa fiche</a>
                <?php if ($v->available == 1): ?>
                    <a class="btn btn-primary tiny" href="<?= Router::url('calls/call/' . $v->url); ?>">Appeler</a>
                <?php elseif ($v->available == 2): ?>
                    <span class="btn btn-danger tiny">Occupé</span>
                <?php else: ?>
                    <span class="btn tiny disabled">Indisponible</span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>