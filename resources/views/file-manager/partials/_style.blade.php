<style>
    .max-height-100 {
        max-height: 100%;
    }

    .master-file-manager {
        position: relative;
        height: 75vh;
        overflow: hidden;
    }

    .master-file-manager .sidebar-container {
        position: relative;
        height: 100%;
    }

    .master-file-manager .sidebar-container .storage-status-bar {
        position: absolute;
        bottom: 2rem;
        background: #FFF;
        left: 0;
    }

    .master-file-manager .sidebar-list {
        display: flex;
        flex-wrap: wrap;
        gap: .75rem;
        list-style: none;
        padding: .75rem 0;
    }

    .master-file-manager .sidebar-list .sidebar-item {
        width: 100%;
    }

    .master-file-manager .folder-files-container {
        position: relative;
        height: 100%;
        overflow-x: auto;
    }

    .master-file-manager .folder {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: .85rem;
        justify-content: start;
    }

    .master-file-manager .folder .folder-item {
        border: 0;
        width: 140px;
        display: flex;
        cursor: pointer;
        font-size: .85rem;
        padding: .5rem .75rem;
        border-radius: .325rem;
        flex-direction: column;
        justify-content: center;
        box-shadow: 1px 1px 10px #00000017;
        transition: .25s ease-in all;
    }

    .master-file-manager .folder .folder-item:hover {
        box-shadow: 1px 1px 10px #00000024;
    }

    .master-file-manager .folder .folder-item .item-name {
        color: #000;
        font-size: .8rem;
        font-weight: 600;
        padding: 5px 0 0 0;
        user-select: none;
    }

    .master-file-manager .folder .folder-item .item-size {
        color: #000;
        font-size: .7rem;
        font-weight: 600;
        user-select: none;
    }

    .master-file-manager table {
        user-select: none;
    }
</style>