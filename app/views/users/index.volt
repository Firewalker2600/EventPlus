
{{ content() }}

<div class="profile left">
    {{ form('user/index', 'id': 'profileForm', 'onbeforesubmit': 'return false') }}
        <div class="clearfix">
            <label for="jmeno">Vaše jméno:</label>
            <div class="input">
                {{ text_field("jmeno", "size": "30", "class": "span6") }}
                <div class="alert" id="name_alert">
                    <strong>Varování!</strong> Prosím zadejte vaše jméno
                </div>
            </div>
        </div>
        <div class="clearfix">
                    <label for="prijmeni">Vaše příjmení:</label>
                    <div class="input">
                        {{ text_field("prijmeni", "size": "30", "class": "span6") }}
                        <div class="alert" id="name_alert">
                            <strong>Varování!</strong> Prosím zadejte vaše příjmení
                        </div>
                    </div>
                </div>
        <div class="clearfix">
            <label for="email">Váš email:</label>
            <div class="input">
                {{ text_field("email", "size": "30", "class": "span6") }}
                <div class="alert" id="email_alert">
                    <strong>Varování</strong> Prosím zadejte váš email
                </div>
            </div>
        </div>
        <div class="clearfix">
                    <label for="spolecnost">Váše společnost:</label>
                    <div class="input">
                        {{ text_field("spolecnost", "size": "30", "class": "span6") }}
                        <div class="alert" id="email_alert">
                            <strong>Varování</strong> Prosím vyplňte vaší společnost
                        </div>
                    </div>
                </div>
        <div class="clearfix">
            {{ submit_button("Aktualizovat", "class": "btn btn-primary btn-large btn-info mt-2") }}

            &nbsp;
        </div>
    </form>
</div>