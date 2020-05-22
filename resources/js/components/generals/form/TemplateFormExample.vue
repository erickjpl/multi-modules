<template>
    <ValidationObserver ref='obs'>
        <v-card class='elevation-12' slot-scope='{ invalid, validated }'>
            <v-toolbar dark color='primary'>
                <v-toolbar-title>VeeValidate Providers: Refactored</v-toolbar-title>
            </v-toolbar>

            <v-card-text>
                <v-form>
                    <form-text-field rules='required|max:10' v-model='name' label='Name' type='text' :counter='10' />

                    <form-text-field rules='required|email' v-model='email' label='E-mail' type='email' />

                    <form-text-field rules='required' v-model='password' label='Password' type='password' />

                    <form-select rules='required' v-model='select' label='Select' :items='items' />

                    <form-checkbox rules='required' v-model='checkbox' :label='option.label' v-for='option in options' :key='option.value' :content='option.value' />

                    <form-switch rules='required' v-model='switches' :label='option.label' v-for='option in optSwitch' :key='option.value' :content='option.value' />

                    <p>Opcion seleccionada: [{{checkbox}}]</p>

                    <p>Switches - Array <br> {{ switches }}</p>

                    <p>{{ ex7 || 'null' }}</p>
                    <v-radio-group v-model="ex7" column>
                        <v-radio
                            label="red"
                            color="red"
                            value="red"
                        ></v-radio>
                        <v-radio
                            label="red darken-3"
                            color="red darken-3"
                            value="red darken-3"
                        ></v-radio>
                        <v-radio
                            label="indigo"
                            color="indigo"
                            value="indigo"
                        ></v-radio>
                        <v-radio
                            label="indigo darken-3"
                            color="indigo darken-3"
                            value="indigo darken-3"
                        ></v-radio>
                        <v-radio
                            label="orange"
                            color="orange"
                            value="orange"
                        ></v-radio>
                        <v-radio
                            label="orange darken-3"
                            color="orange darken-3"
                            value="orange darken-3"
                        ></v-radio>
                    </v-radio-group>

                    <hr> <p>{{ radio || 'null' }}</p>

                    <form-radio v-model="radio">
                        <template v-for='radio in radioItem' slot='radio'>
                            <v-radio 
                                :label='radio.label'
                                :color='radio.color'
                                :value='radio.value'
                            ></v-radio>
                        </template>
                    </form-radio>
                </v-form>
            </v-card-text>

            <v-card-actions>
                <v-btn @click='clear'>Clear</v-btn>
                <v-spacer></v-spacer>
                <v-btn @click='submit'>Validate</v-btn>
                <v-btn color='primary' @click='submit' :disabled='invalid || !validated'>Sign Up</v-btn>
            </v-card-actions>
        </v-card>
    </ValidationObserver>
</template>

<script>
    import { ValidationObserver }   from 'vee-validate'
    import FormTextField            from '@/components/form/FormTextField'
    import FormCheckbox             from '@/components/form/FormCheckbox'
    import FormSwitch               from '@/components/form/FormSwitch'
    import FormSelect               from '@/components/form/FormSelect'
    import FormRadio                from '@/components/form/FormRadio'

    export default {
        components: {
            ValidationObserver,
            FormTextField,
            FormCheckbox,
            FormSwitch,
            FormSelect,
            FormRadio
        },
        data: () => ({
            ex7         : 'red',
            radio       : '',
            people      : ['Erick'],
            items       : ['', 'Foo', 'Bar'],
            name        : '',
            email       : '',
            select      : '',
            password    : '',
            checkbox    : [],
            switches    : [],
            options     : [
                { label: 'CHECKBOX UNO', value: 'CHECKBOX-1' },
                { label: 'CHECKBOX DOS', value: 'CHECKBOX-2' }
            ],
            optSwitch   : [
                { label: 'SWITCH UNO', value: 'SWITCH-1' },
                { label: 'SWITCH DOS', value: 'SWITCH-2' }
            ],
            radioItem   : [
                { label: 'red',     color: 'red',    value: 'red' },
                { label: 'indigo',  color: 'indigo', value: 'indigo' },
                { label: 'orange',  color: 'orange', value: 'orange' }
            ]
        }),
        methods: {
            async clear() {
                this.name = this.email = this.select = this.checkbox = this.password = ''
                this.$nextTick(() => {
                    this.$refs.obs.reset()
                })
            },
            async submit() {
                const result = await this.$refs.obs.validate()
            }
        }
    };
</script>
