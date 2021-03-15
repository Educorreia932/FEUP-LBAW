<?php function settings_privacy() { ?>
    <script defer src="../js/master_checkboxes.js"></script>

    <h2 class="my-4">Privacy & Notifications</h2>

    <h3 class="mt-4 mb-2">Privacy</h3>

    <div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="switch-nsfw" checked>
            <label class="form-check-label" for="switch-nsfw">NSFW Auctions</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="switch-use-data">
            <label class="form-check-label" for="switch-use-data">Use data to improve Trade-a-Bid</label>
        </div>
    </div>

    <h3 class="mt-4 mb-2">Notifications</h3>

    <div class="master-checkbox">
        <div class="form-check form-switch master">
            <input class="form-check-input" type="checkbox" id="switch-notifications">
            <label class="form-check-label" for="switch-notifications">Notifications</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="switch-outbid-notifications" checked disabled>
            <label class="form-check-label" for="switch-outbid-notifications">Outbid Notifications</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="switch-start-auction-notifications" checked disabled>
            <label class="form-check-label" for="switch-start-auction-notifications">Start auction notifications</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="switch-user-activity-notifications" disabled>
            <label class="form-check-label" for="switch-user-activity-notifications">Followed user activity notifications</label>
        </div>
    </div>
<?php } ?>
