<div data-control="toolbar loader-container">
    <a
        href="<?= Backend::url('appad/ad/ads/create') ?>"
        class="btn btn-primary">
        <i class="icon-plus"></i>
        <?= __("New :name", ['name' => 'Ad']) ?>
    </a>

    <div class="toolbar-divider"></div>

    <button
        class="btn btn-secondary"
        data-request="onDelete"
        data-request-message="<?= __("Deleting...") ?>"
        data-request-confirm="<?= __("Are you sure?") ?>"
        data-list-checked-trigger
        data-list-checked-request
        disabled>
        <i class="icon-delete"></i>
        <?= __("Delete") ?>
    </button>

    <div class="toolbar-divider"></div>

    <button
        class="btn btn-default oc-icon-upload"
        data-request="onAlgoliaSync"
        data-request-message="<?= __("Syncing with Algolia...") ?>"
        data-stripe-load-indicator>
        Algolia Sync
    </button>
</div>
