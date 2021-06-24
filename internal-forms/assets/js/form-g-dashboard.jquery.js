$(document).ready(function () {

    function adjustTextAreaHeight(element) {
      if (!element.length) {
        element = $(this);
        // Get full scroll height of text area element
        var scrollHeight = element.prop('scrollHeight');
        if (scrollHeight == 0) {
            scrollHeight = 24;
        }
        // Some browsers do not shrink element, so we set 0 height at first
        element.innerHeight(0).innerHeight(scrollHeight);
      }
    }

    function replaceForm($form) {
        $('.tooltip').hide();
        var height = $form.outerHeight();
        $form.replaceWith('<div class="loading-animation-container" id="form-placeholder" style="height:'+height+'px;"></div>');
    }

    function activateForms() {
        // apply form behaviors
        $('[data-toggle="tooltip"]').tooltip();
        $('.course-note textarea').each(adjustTextAreaHeight);
        $('#form-g-forms-container .form-g-record form').submit(function(event){
            updateForm($(this).closest('.form-g-record'));
            event.preventDefault();
        });
    }

    function getForms() {
        // baseUrl is set in Form_g_dashboard.php inside render_view()
        $('#form-g-forms-container').html('<div class="loading-animation-container">'+"\n\t"+
            '<img src="'+baseUrl+'assets/images/loading_icon.gif">'+"\n"+
        '</div>');
        $('.campus-filter-button, .filter-select, .sort-button').prop('disabled', true);
        var state = $('#state').val();
        var campus = $('#filter-campus').val();
        var dept = $('#filter-department').val();
        var subject = $('#filter-subject').val();
        var affiliation = $('#filter-affiliation').val();
        var order = $('#sort-order').val();
        $.ajax({
            url: baseUrl+'form_g_dashboard/ajaxGetFilteredForms',
            type: 'POST',
            data: {
                state: state,
                campus: campus,
                dept: dept,
                subject: subject,
                affiliation: affiliation,
                sort_order: order
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                // insert forms
                $('#form-g-forms-container').html(response);
                activateForms();

                getDepartments();
            }
        });
    }

    function getDepartments() {
        // baseUrl is set in Form_g_dashboard.php inside [before_closing_head]
        var state = $('#state').val();
        var campus = $('#filter-campus').val();
        var dept = $('#filter-department').val();
        var subject = $('#filter-subject').val();
        var affiliation = $('#filter-affiliation').val();
        var order = $('#sort-order').val();
        $.ajax({
            url: baseUrl+'form_g_dashboard/ajaxGetDepartments',
            type: 'POST',
            data: {
                state: state,
                campus: campus,
                dept: dept,
                subject: subject,
                affiliation: affiliation,
                sort_order: order
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                // insert department select options
                // $('#form-g-forms-container').html(response);
                var optionStrings = JSON.parse(response);
                $('#filter-department').html(optionStrings[0]);
                $('#filter-subject').html(optionStrings[1]);
                $('.campus-filter-button, .filter-select, .sort-button').removeAttr('disabled');
            }
        });
    }

    function updateCounts() {
        $.ajax({
            url: baseUrl+'form_g_dashboard/get_counts',
            type: 'POST',
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                var counts = response.split(',');
                $('#active-form-count').html(counts[0]);
                $('#verified-form-count').html(counts[1]);
                $('#archived-form-count').html(counts[2]);
            }
        });
    }

    function updateForm($form) {
        replaceForm($form); // create #form-placeholder
        var state = $('#state').val();
        var campus = $('#filter-campus').val();
        // get all the values from the form into a map
        var values = new Map();
        $form.find('input').each(function(){
            values[$(this).attr("name")] = $(this).val();
        });
        $form.find('select').each(function(){
            values[$(this).attr("name")] = $(this).find(':selected').val();
        });
        $form.find('textarea').each(function(){
            values[$(this).attr("name")] = $(this).val();
        });
        // console.log(values);
        $.ajax({
            url: baseUrl+'form_g_dashboard/ajaxUpdateRecord',
            type: 'POST',
            data: {
                state: state,
                campus: campus,
                form_values: JSON.stringify(values),
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                $('.tooltip').hide();
                $('#form-placeholder').replaceWith(response);
                activateForms();
            }
        });
    }

    function reloadForm($form) {
        replaceForm($form);
        var state = $('#state').val();
        var campus = $('#filter-campus').val();
        var formId = $form.find('input[name="form_id"]').val();
        $.ajax({
            // baseUrl is set in Form_g_dashboard.php inside [before_closing_head]
            url: baseUrl+'form_g_dashboard/ajaxGetForm',
            type: 'POST',
            data: {
                form_id: formId,
                state: state,
                campus: campus
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                $('#form-placeholder').replaceWith(response);
                activateForms();
            }
        });
    }

    function changeFormState($form, newState) {
        var state = $('#state').val();
        var campus = $('#filter-campus').val();
        var formId = $form.find('input[name="form_id"]').val();
        $.ajax({
            // baseUrl is set in Form_g_dashboard.php inside [before_closing_head]
            url: baseUrl+'form_g_dashboard/ajaxUpdateRecordState',
            type: 'POST',
            data: {
                form_id: formId,
                campus: campus,
                current_state: state,
                new_state: newState
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                $('.tooltip').hide();
                $form.animate({height: 0, opacity: 0}, 350, function(){
                    $form.remove();
                });
                updateCounts();
            }
        });
    }

    function deleteForm($form) {
        var formId = $form.find('input[name="form_id"]').val();
        $.ajax({
            // baseUrl is set in Form_g_dashboard.php inside [before_closing_head]
            url: baseUrl+'form_g_dashboard/ajaxDeleteRecord',
            type: 'POST',
            data: {
                form_id: formId
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                $('.tooltip').hide();
                $form.animate({height: 0, opacity: 0}, 350, function(){
                    $form.remove();
                });
                updateCounts();
            }
        });
    }

    function deleteCourse($course) {
        var courseId = $course.find('input.course-id').val();
        var $form = $course.closest('.form-g-record');
        $.ajax({
            // baseUrl is set in Form_g_dashboard.php inside [before_closing_head]
            url: baseUrl+'form_g_dashboard/ajaxDeleteCourse',
            type: 'POST',
            data: {
                course_id: courseId
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                $('.tooltip').hide();
                reloadForm($form);
                updateCounts();
            }
        });
    }

    function processBulkActions(button) {
        $this = $(button);
        var action = $this.attr('data-action');
        var marked = [];
        $('#form-g-forms-container input[type="checkbox"]:checked').each(function() {
            marked.push($(this).val());
        });
        $.ajax({
            // baseUrl is set in Form_g_dashboard.php inside [before_closing_head]
            url: baseUrl+'form_g_dashboard/ajaxProcessBulkActions',
            type: 'POST',
            data: {
                marked: marked,
                action: action
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                // $('#form-g-forms-container').html(response);
                location.reload();
            }
        });
    }

    function getDate() {
        var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();

        var output = ((''+month).length<2 ? '0' : '') + month + '-' +
            ((''+day).length<2 ? '0' : '') + day + '-' + d.getFullYear();

        return output;
    }

    function getFormsForDownload(filter) {
        if (filter == 'filtered') {
            var state = $('#state').val();
            var campus = $('#filter-campus').val();
            var dept = $('#filter-department').val();
            var subject = $('#filter-subject').val();
            var affiliation = $('#filter-affiliation').val();
            var order = $('#sort-order').val();
        } else {
            var dept = 'all';
            var subject = 'all';
            var affiliation = 'all';
        }
        $.ajax({
            // baseUrl is set in Form_g_dashboard.php inside [before_closing_head]
            url: baseUrl+'form_g_dashboard/export_data',
            type: 'POST',
            data: {
                state: state,
                campus: campus,
                dept: dept,
                subject: subject,
                affiliation: affiliation,
                sort_order: order
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response, status, xhr) {
                //// this function is from https://stackoverflow.com/questions/16086162/handle-file-download-from-ajax-post
                // check for a filename
                var filename = "summer_assignments_"+state+"_"+getDate()+".csv";
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }

                var type = xhr.getResponseHeader('Content-Type');
                var blob = new Blob([response], { type: type });

                if (typeof window.navigator.msSaveBlob !== 'undefined') {
                    // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                    window.navigator.msSaveBlob(blob, filename);
                } else {
                    var URL = window.URL || window.webkitURL;
                    var downloadUrl = URL.createObjectURL(blob);

                    if (filename) {
                        // use HTML5 a[download] attribute to specify filename
                        var a = document.createElement("a");
                        // safari doesn't support this yet
                        if (typeof a.download === 'undefined') {
                            window.location = downloadUrl;
                        } else {
                            a.href = downloadUrl;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                        }
                    } else {
                        window.location = downloadUrl;
                    }

                    setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
                }
            }
        });
    }

////////// filtering and sorting ///////////

    // filter forms by campus
    $('.campus-filter-button').on('click', function() {
        $this = $(this);
        $('.campus-filter-button').removeClass('selected-button');
        $this.addClass('selected-button');
        $('#filter-campus').val($this.val());
        getForms();
    });

    // filter forms by user department
    // filter forms by course subject
    // filter forms by employment status
    $('.filter-select').on('change', function() {
        $this = $(this);
        if ($this.val() !== 'all') {
            $this.removeClass('inactive-select');
        } else {
            $this.addClass('inactive-select');
        }
        getForms();
    });

    // sort forms by name or date
    $('.sort-button').on('click', function() {
        $this = $(this);
        $('.sort-button').removeClass('selected-button');
        $this.addClass('selected-button');
        $('#sort-order').val($this.val());
        getForms();
    });

    // download button
    $('.download-button').on('click', function() {
        getFormsForDownload($(this).attr('data-filters'));
    });

/////// bulk actions and behaviors NOT inside individual forms

    // toggle all checkboxes when select-all checkbox is clicked
    $('#select-all').click(function() {
        $this = $(this);
        var checked = $this.prop('checked');
        $('input[type=checkbox]').not($this).prop('checked', checked);
    });

    // toggle checkboxes of obsolete records when select-all-obsolete checkbox is clicked
    $('#select-all-obsolete').click(function() {
        $this = $(this);
        var checked = $this.prop('checked');
        $('.obsolete input[type=checkbox]').not($this).prop('checked', checked);
    });

    $('.bulk-action-button').on('click',function() {
        processBulkActions(this);
    });

//////// behaviors on elements inside individual forms

    $('#form-g-forms-container').on('click', '.edit-button', function() {
        $this = $(this);
        $form = $this.closest('.form-g-record');
        $this.closest('.row').find('a, button').addClass('begin-hidden');
        $this.closest('.row').find('.save-button, .add-course-button').removeClass('begin-hidden');
        $form.find('.note-button').addClass('begin-hidden').next().removeClass('begin-hidden');
        $form.find('.hidden-delete').removeClass('hidden-delete');
        $form.find('.course-note').slideDown().find('input[type=text]').removeAttr('readonly').css('border', '2px inset');
        $form.removeClass('read-only').find('input[type=text]').removeAttr('readonly');
        $form.find('select').removeAttr('disabled');
        $form.find('textarea').removeAttr('readonly').removeAttr('disabled').parent().removeClass('read-only');
    });

    // save buttons
    $('#form-g-forms-container').on('click', '.save-button', function() {
        updateForm($(this).closest('.form-g-record'));
    });

    // verify, archive, reactivate buttons
    $('#form-g-forms-container').on('click', '.state-change-button', function() {
        var $this = $(this);
        var newState = $this.attr('data-newstate');
        var $form = $this.closest('.form-g-record');
        changeFormState($form, newState);
    });

    // delete form buttons
    $('#form-g-forms-container').on('click', '.delete-button', function() {
        deleteForm($(this).closest('.form-g-record'));
    });

    // delete course buttons
    $('#form-g-forms-container').on('click', '.delete-course-button', function() {
        if (window.confirm("Are you sure you want to delete this course? This action is permanent and cannot be undone.")) {
            deleteCourse($(this).closest('.user-course'));
        }

    });

    // history button
    $('#form-g-forms-container').on('click', '.history-button', function() {
        $(this).closest('.form-g-record').find('.user-revisions').slideToggle();
    });

    // note button
    $('#form-g-forms-container').on('click', '.note-button', function() {
        $this = $(this);
        $this.addClass('hidden');
        $this.next().removeClass('begin-hidden');
        $this.closest('.user-course').find('.course-note').slideDown('fast').find('textarea').removeAttr('readonly').css('border', '1px solid #333');
    });

    // expand note textarea for multi-line notes
    $('#form-g-forms-container').on('keydown', '.course-note textarea', adjustTextAreaHeight);

    // add a course to a user
    $('#form-g-forms-container').on('click', '.add-course-button', function() {
        $this = $(this);
        var $courses = $this.closest('.form-g-record').find('.user-course');
        var courseCount = $courses.length;
        var $lastCourse = $courses.last();
        $.ajax({
            // baseUrl is set in Form_g_dashboard.php inside [before_closing_head]
            url: baseUrl+'form_g_dashboard/ajaxGetCourseFields',
            type: 'POST',
            data: {courseNumber: courseCount},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
            },
            success: function(response) {
                // append the fields returned from the ajax request
                // after the next element after the last course,
                // which is the note row after the last course row
                $lastCourse.after(response);
                $lastCourse.closest('.form-g-record').find('input[name="course_count"]').val( function(i, oldval) {
                    return ++oldval;
                });
            }
        });
    });

    // functions to run on load
    $('[data-toggle="tooltip"]').tooltip();
    getForms();
    updateCounts();
    $('.course-note textarea').each(adjustTextAreaHeight);

});
