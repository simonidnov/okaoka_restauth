<br/>
<link rel="stylesheet" href="/css/pages/application.css">
<div class="page_content">
    <h1 class="big_title">Bornes Enfant OkaOka</h1>
    <div class="page_block">
        <div class="classic_button red center">
            Télécharger la dernière version <b>Borne Okaïdi win32</b>
        </div>
    </div>
    <div class="page_block white">
        <div class="formulaire" id="switch_os_form">
            <div class="line">
                <div class="tabs" id="switch_os_tab" data-type="radio">
                    <div class="tab forty" data-list="switch_account_tab">osX 64</div>
                    <div class="tab forty" data-list="switch_account_tab">Win 32</div>
                    <div class="tab forty" data-list="switch_account_tab">Win 64</div>
                    <div class="tab forty" data-list="switch_account_tab">Linux 64</div>
                </div>
            </div>
        </div>
        <div class="line_list" id="app_list_content">
            <?php
                $files1 = scandir("./uploads/release_versions");
                foreach($files1 as $file){
                    if(strrpos($file, '.zip')){
                        echo '<div class="item" data-plateform="'.explode('_', $file)[1].'">
                            <div class="label">
                                Version '.str_replace(".zip", "", explode('_', $file)[2]).'
                            </div>
                            <div class="label">
                                '.explode('_', $file)[1].'
                            </div>
                            <div class="description">
                                '.$file.'
                            </div>
                            <div class="right_pos">
                            <a href="/uploads/release_versions/'.$file.'"><div class="classic_button grey">Télécharger</div></a>
                            </div>
                        </div>';
                    }
                }
            ?>
        </div>
    </div>
    <!--<div class="page_block white">
        <div class="formulaire" id="app_upload_form">
            <div class="line">
                <div class="title">Uploader une nouvelle version</div>
                <label class="edit" for="version_number"><span class="">Numéro de version</span></label>
                <input type="text" id="version_number"/>
                <label class="edit" for="whats_new"><span class="">Nouveautés</span></label>
                <textarea type="text" id="whats_new"></textarea>
            </div>
            <div class="line">
                <div class="radio_list" id="os_picker">
                    <div class="title">Sélectionnez l'OS de destination</div>
                    <div class="line_separator compact"></div>
                    <div class="line">
                        <label class="small_label_left" for="radio_osx64">osX mac 64 bits</label>
                        <div class="radio right" id="radio_osx64" data-list="1">
                            <div class="inset"></div>
                        </div>
                    </div>
                    <div class="line_separator compact"></div>
                    <div class="line">
                        <label class="small_label_left" for="radio_win32">Windows 32 bits</label>
                        <div class="radio right" id="radio_win32" data-list="2">
                            <div class="inset"></div>
                        </div>
                    </div>
                    <div class="line_separator compact"></div>
                    <div class="line">
                        <label class="small_label_left" for="radio_win64">Windows 64bits</label>
                        <div class="radio right" id="radio_win64" data-list="3">
                            <div class="inset"></div>
                        </div>
                    </div>
                    <div class="line_separator compact"></div>
                    <div class="line">
                        <label class="small_label_left" for="radio_linux32">Linux 32bits</label>
                        <div class="radio right" id="radio_linux32" data-list="3">
                            <div class="inset"></div>
                        </div>
                    </div>
                    <div class="line_separator compact"></div>
                    <div class="line">
                        <label class="small_label_left" for="radio_linux64">Linux 64bits</label>
                        <div class="radio right" id="radio_linux64" data-list="3">
                            <div class="inset"></div>
                        </div>
                    </div>
                    <div class="line_separator compact"></div>
                </div>
            </div>
            <div class="line">
                <div class="switch right" id="installer_check">
                    <div class="dot"></div>
                </div>
                <h4 data-for="installer_check">Cocher si c'est un installer DMG ou Windows</h4>
            </div>
            <div class="line_separator compact"></div>
            <div class="line">
                <label class="formular_button center" for='file_upload' style="display:table;">Télécharger le fichier .zip</label>
                <input type="file" id="file_upload"/>
            </div>
            <div class="line">
                <div class="small_title">
                    Après avoir vérifié les informations ci-dessous cliquez sur envoyer.
                    Votre version sera soumise à vérification avant d'être validée.
                </div>
            </div>
            <div class="line">
                <div class="formular_button center" id="upload_button" data-validate="1">Envoyer une nouvelle version</div>
            </div>
        </div>
    </div>-->
</div>
<script src="/js/pages/application.js"></script>

<script type="text/template" id="list_app_template">
    <div class="item">
        <div class="label">
            Version <%= release_version %>
        </div>
        <div class="label">
            <%= os %>
        </div>
        <div class="description">
            <%= whats_new %>
        </div>
        <div class="right_pos">
        <a href="/uploads/release_versions/<%= file_name %>.zip"><div class="classic_button grey">Télécharger</div></a>
        </div>
    </div>
</script>