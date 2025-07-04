<script >
    function test() {
        return {
            resultado: 0,
            connectedDevice: {
                id: 'No hay dispositivos conectados',
                name: 'No hay dispositivos conectados'
            },
            
            inicio() {
                // Echo.channel('channel-test')
                // .listen('TestEvent', (event) => {
                //     console.log(event);
                //     this.resultado = this.resultado + 1
                // }).error((error) => {
                //     console.error(error);
                // });

                // Echo.join('users')
                // .here((event) => {
                //     console.log(event);
                //     this.resultado = this.resultado + 1
                // })
                // .error((error) => {
                //     console.error(error);
                // });

                // aun no me funciona
                // navigator.usb.addEventListener('connect', event => {
                //     console.log('A USB device has been connected.', event.device);
                // });

                // detecta si el dispositivo USB ha sido desconectado
                navigator.usb.addEventListener('disconnect', event => {
                    console.log('A USB device has been disconnected.', event.device);
                });
                
            },

            async detectBeacons() {
                try {
                    const device = await navigator.bluetooth.requestDevice({
                        acceptAllDevices: true,
                        optionalServices: ['battery_service'],

                        // filters: [
                        //     { 
                        //         // name: 'MTP-II',
                        //         id: 'A+FhsLKPO8CJ5nqTqQOjlQ==',
                        //     }
                        // ]
                    });
                    console.log(`Beacon detectado: ${device.name}`);
                    console.log(device);
                    this.connectedDevice = device;
                    const server = await device.gatt.connect();

                    this.disconnectBluetooth();
                } catch (error) {
                    console.error('Error detectando beacons:', error);
                }
            },

            disconnectBluetooth() {
                if (this.connectedDevice && this.connectedDevice.gatt.connected) {
                    this.connectedDevice.gatt.disconnect();
                    console.log('Dispositivo desconectado');
                } else {
                    console.log('No hay dispositivos conectados.');
                }
            },

            sumar() {
                this.resultado = this.resultado + 1
            },

            toast() {
                @this.$dispatch('showToast', {'title': 'PRUEBA TIPO', 'icon':'info'})
            },

            toast2() {
                toast({'title': 'PRUEBA TIPO', 'icon':'success'})
            },

            mostrarEquiposUsb(){
                navigator.usb.requestDevice({filters:[]}).then((device) => {
                    console.log(
                        'manufacturerName ' + device.manufacturerName,
                        'productName ' + device.productName,
                        'vendorId ' + device.vendorId,
                        'productId ' + device.productId
                    )
                });
            },

            equiposUsbConectados(){
                navigator.usb.getDevices().then((devices) => {
                    console.log(`Total devices: ${devices.length}`);
                    devices.forEach((device) => {
                        console.log(device)
                        console.log(
                            'manufacturerName ' + device.manufacturerName,
                            'productName ' + device.productName,
                            'vendorId ' + device.vendorId,
                            'productId ' + device.productId,
                        );
                    });
                });
            },
        }
    }
</script>
