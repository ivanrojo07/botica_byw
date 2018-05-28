@if($type_address == 'normal')
    <h4 class="modal-title grey" id="myModalLabel">
        Dirección de Envío:
    </h4>
    <div class="row">
        <div class="col-lg-12">
            <h5 class="modal-title grey" id="myModalLabel">
                <strong>Datos del envio:</strong>
            </h5>
        </div>
        <div class="col-lg-12">
            Nombre: {{ $address->name }}
        </div>
        <div class="col-lg-12">
            Email: {{ $address->email }}
        </div>
        <div class="col-lg-12">
            Telefono: {{ $address->telefono }}
        </div>
        <div class="col-lg-12">
            Telefono 
            contacto: {{ $address->contacto }}
        </div>
        <div class="col-lg-12">
        <h5 class="modal-title grey" id="myModalLabel">
            <strong>Dirección:</strong>
        </h5>
        </div>
        <div class="col-lg-3">
            Calle: {{ $address->calle }}
        </div>
        <div class="col-lg-3">
            Num Ext: {{ $address->num_ext }}
        </div>
        <div class="col-lg-3">
            Num Int: {{ $address->num_int }}
        </div>
        <div class="col-lg-3">
            CP: {{ $address->codigop }}
        </div>
        <div class="col-lg-3">
            Colonia: {{ $address->colonia }}
        </div>
        <div class="col-lg-3">
            País: {{ $address->pais }}        </div>
        <div class="col-lg-3">
            Estado: {{ $address->estado }}
        </div>
        <div class="col-lg-3">
            Ciudad: {{ $address->ciudad }}
        </div>
        <div class="col-lg-3">
            Municipio: {{ $address->municipio }}
        </div>
        <div class="col-lg-3">
        </div>
        <hr/>
        <div class="col-lg-12">
            Entre: {{ $address->entre1 }} Y Entre: {{ $address->entre2 }}
        </div>
        <div class="col-lg-12">
           Referencias: {{ $address->references }}
        </div>
    </div>
@elseif($type_address == 'paypal')
    <div class="row">
        <div class="col-lg-3">
            Calle 1: {{ $address->line1 }}
        </div>
        <div class="col-lg-3">
            Calle 2: {{ $address->line2 }}
        </div>
        <div class="col-lg-3">
            País: {{ $address->country_code }}
        </div>
        <div class="col-lg-3">
            Estado: {{ $address->state }}
        </div>
        <div class="col-lg-3">
            Ciudad: {{ $address->city }}
        </div>
        <div class="col-lg-3">
            CP: {{ $address->postal_code }}
        </div>
    </div>
@endif