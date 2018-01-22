
// Only script specific to this form goes here.

// General-purpose routines are in a separate file.

  function validateOnSubmit() {

    var elem;

    var errs=0;

    // execute all element validations in reverse order, so focus gets

    // set to the first one in error.

    if (!validateTelnr  (document.forms.demo.telnr, 'inf_telnr', true)) errs += 1; 

    if (!validateAge    (document.forms.demo.age,   'inf_age',  false)) errs += 1; 

    if (!validateEmail  (document.forms.demo.email, 'inf_email', true)) errs += 1; 

    if (!validatePresent(document.forms.demo.from,  'inf_from'))        errs += 1; 



    if (errs>1)  alert('There are fields which need correction before sending');

    if (errs==1) alert('There is a field which needs correction before sending');



    return (errs==0);

  };

