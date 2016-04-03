
{!!
\Easy\Form\Modal::make('~layouts.form.modals.modal')
->id('frm_detalii_abonament_avansat')
->caption('Abonament avansat')
->closable(true)
->body('<div id="frm_detalii_abonament_avansat_inner">' . \View::make('static-pages.content.abonament_avasat')->render() . '</div>')
->footer('<button type="button" class="btn btn-default" data-dismiss="modal">Renunţă</button>')
->out()
!!}


{!!
\Easy\Form\Modal::make('~layouts.form.modals.modal')
->id('frm_detalii_abonament_standard')
->caption('Abonament Standard')
->closable(true)
->body('<div id="frm_detalii_abonament_standard_inner">' . \View::make('static-pages.content.abonament_standard')->render() . '</div>')
->footer('<button type="button" class="btn btn-default" data-dismiss="modal">Renunţă</button>')
->out()
!!}


{!!
\Easy\Form\Modal::make('~layouts.form.modals.modal')
->id('frm_detalii_abonament_free')
->caption('Abonament Free')
->closable(true)
->body('<div id="frm_detalii_abonament_free_inner">' . \View::make('static-pages.content.abonament_free')->render() . '</div>')
->footer('<button type="button" class="btn btn-default" data-dismiss="modal">Renunţă</button>')
->out()
!!}