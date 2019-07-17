const app = new Vue({
    el: '#app',
    data: function() {
        return {
            selectedDate: '',
            selectedHour: '',
            selectedUbication: '',
            observations: '',
            applicant: '',
            ubications: [{
                value: 'Operadora',
                label: 'Operadora'
              }, {
                value: 'Cedis',
                label: 'Cedis'
              }, {
                value: 'Fit Apparel',
                label: 'Fit Apparel'
              }],
              selectedOk: '',
              solicitudes: []
        }
    },
    mounted() {
        this.getSolicitudes();
    },
    methods: {
        createSolicitud() {

          if ( this.selectedDate == '' || this.applicant == '' || this.selectedUbication == '' || this.selectedHour == '' || this.observations == '' ) {
            this.openWarningNot();
          } else {
              axios.post(window.location.href + 'solicitud', {
                fecha: this.selectedDate,
                solicitante: this.applicant,
                ubicacion: this.selectedUbication,
                hora: this.selectedHour,
                observaciones: this.observations
              })
              .then( (response) => {
                console.log(response.data);

                if ( response.data == 'timeError' ) {
                  this.openWarningTimeNot();

                } else {
                
                  this.selectedDate = '';
                  this.applicant = '';
                  this.selectedUbication = '';
                  this.selectedHour = '';
                  this.observations = '';

                  this.getSolicitudes();

                  this.openSuccessNot();
                }

              })
              .catch(function (error) {
                console.log(error);
              });
          }
        },
        openSuccessNot() {
          this.$notify({
            title: 'Correcto',
            message: 'Se ha registrado su solicitud',
            type: 'success'
          });
        },
        openErrorNot() {
          this.$notify.error({
            title: 'Error',
            message: 'No se registró su solicitud'
          });
        },
        openWarningNot() {
          this.$notify({
            title: 'Atención',
            message: 'Llena todos los campos antes de enviar',
            type: 'warning'
          });
        },
        openWarningTimeNot() {
          this.$notify.error({
            title: 'Solicitud rechazada',
            message: 'Día y fecha seleccionados ya están ocupados...'
          });
        },
        getSolicitudes() {
          axios.get( window.location.href + 'solicitudes')
                .then( (res) => {
                    // handle success
                    const loading = this.$loading({
                      lock: true,
                      text: 'Cargando...',
                      spinner: 'el-icon-loading',
                      background: 'rgba(0, 0, 0, 0.7)'
                    });
                    this.solicitudes = [];

                    res.data.forEach( (solicitud) => {
                      this.solicitudes.push(solicitud);
                    });

                    console.log(this.solicitudes);
                    loading.close();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    loading.close();
                })
                .finally(function () {
                    // always executed
                    loading.close();
                });
        },
        handleDelete(index, row) {
          var idSolicitud = row.id;

          axios.get( window.location.href + 'solicitud/' + idSolicitud)
          .then( (response) => {

            this.getSolicitudes();
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          });
        }
    }
    
})