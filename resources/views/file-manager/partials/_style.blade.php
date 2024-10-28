<style>
    .master-file-manager .folder {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: .85rem;
        justify-content: start;
    }

    .master-file-manager .folder .folder-item {
        display: flex;
        flex-direction: column;
        justify-content: center;
        border: 1px solid #cccccc;
        padding: .25rem 1rem;
        border-radius: .325rem;
        font-size: .85rem;
        cursor: pointer;
        width: 140px;
    }

    .master-file-manager .folder .folder-item .item-name {
        color: #000;
        font-size: .8rem;
        font-weight: 600;
    }

    .master-file-manager .folder .folder-item .item-size {
        color: #000;
        font-size: .7rem;
        font-weight: 600;
    }
</style>