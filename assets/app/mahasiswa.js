/*!
* Module Mahasiswa
* Kumpulan javascript module mahasiswa
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Form Validation, Bootstraps JS,
* @see https://github.com/nitinegoro/pertiba-perpus
*/

jQuery(function($) {
	// validasi form add mahasiswa
    $('#form-tambah-mahasiswa').formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            npm: {
                validators: {  
                   	remote: {
                        message: 'NPM sudah tersedia.',
                        type: 'POST',
                        url: base_url + '/api/mhs/auth_npm',
                        delay: 1000
                    }
                },
            },
        }
    });

    // validasi form update mahasiswa
    $('#form-update-mahasiswa').formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            npm: {
                validators: {  
                   	remote: {
                        message: 'NPM sudah tersedia.',
                        type: 'POST',
                        url: base_url + '/api/mhs/auth_npm?method=update&id=' + $('#form-update-mahasiswa').data('id'),
                        delay: 1000
                    }
                },
            },
        }
    });

    // dialog delete mahasiswa
    $('.open-mahasiswa-delete').click( function() {
    	$('#modal-delete-mahasiswa').modal('show');
    	$('#button-delete').attr('href', base_url + '/mahasiswa/delete/' + $(this).data('id'));
    	return false;
    });

    // dialog delete multiple mahasiswa
    $('.open-delete-mahasiswa-multiple').click( function() {
    	if($('input[name="mahasiswa[]"]').is(':checked') != '') {
    		$('#modal-delete-mahasiswa-multiple').modal('show');
    	}
    	return false;
    });


	$('#file-excel').ace_file_input({
		style: false,
		btn_choose: 'Pilih file dari komputer anda',
		btn_change: 'Ganti file',
		no_icon: 'ace-icon fa fa-upload',
		droppable: true,
		allowExt: ['xlsx']
	});

    // Uploads IMPORT data mahasiswa 
	$('#form-import-mahasiswa').formValidation({
	    excluded: [':disabled'],
	    fields: {
	        excel: { 
                validators: { 
	               notEmpty: {  message: 'Harap isi File.' },
	               file: { extension: 'xlsx', maxSize: 97152 }
	           }  
            }
	    }
	})
	.on('success.form.fv', function(e) {
        e.preventDefault();
        $('div#pro').removeClass('hide');
        var $form     = $(e.target);
        $.ajaxFileUpload({
            url : base_url + '/mahasiswa/set_import', 
            secureuri : false,
            fileElementId :'file-excel',
            dataType : 'json',
            success : function (res)
            {  
                $('div#pro').addClass('hide');	
                if(res.status != 'error') 
                {
                    show_alert(res.message,'success','check');
                } else {
                    show_alert(res.message,'danger','warning');
                }
                
               $('input[name="excel"]').ace_file_input('reset_input');
               $form.formValidation('disableSubmitButtons', false).formValidation('resetForm', true); 
            },
            error: function(res) 
            {
                $('div#pro').addClass('hide');
                show_alert("Gagal Mengimport data.",'danger','warning');
            }
        });
        return false;
	});
});
