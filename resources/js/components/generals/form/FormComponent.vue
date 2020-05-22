<template>
	<ValidationObserver ref="obs">
		<v-card class="elevation-12" slot-scope="{ invalid, validated }">
			<v-toolbar dark color="primary">
				<slot name="title" />
				<!-- <v-toolbar-title>VeeValidate Providers: Refactored</v-toolbar-title> -->
			</v-toolbar>

			<v-card-text>
				<v-form>
					<slot name="inputs" />

				<!--
					<form-text-field rules="required|max:10" v-model="name" :counter="10" label="Name" type="text" />

					<form-text-field rules="required|email" v-model="email" label="E-mail" type="email" />

					<form-text-field rules="required" v-model="password" label="Password" type="password" />

					<form-select rules="required" :items="items" v-model="select" label="Select" />
				-->

					<!-- Do this one yourself!
					<ValidationProvider rules="required" name="checkbox">
					<v-checkbox
					slot-scope="{
					errors,
					valid
					}"
					v-model="checkbox"
					:error-messages="errors"
					:success="valid"
					value="1"
					label="Option"
					type="checkbox"
					required
					></v-checkbox>
					</ValidationProvider> -->
				</v-form>
			</v-card-text>

			<v-card-actions>
				<slot name="actions" />
			<!--
				<v-btn @click="clear">Clear</v-btn>
				<v-spacer></v-spacer>
				<v-btn @click="submit">Validate</v-btn>
				<v-btn color="primary" @click="submit" :disabled="invalid || !validated">Sign Up</v-btn>
			-->
			</v-card-actions>
		</v-card>
	</ValidationObserver>
</template>

<script>
	import { ValidationObserver } 	from "vee-validate"
	import FormTextField 			from '@/components/form/FormTextField'
	import FormSelect 				from '@/components/form/FormSelect'

	export default {
		data: () => ({
			items		: ["", "Foo", "Bar"],
			name		: "",
			email		: "",
			select		: "",
			password	: "",
			checkbox	: ""
		}),
		components: {
			ValidationObserver,
			FormTextField,
			FormSelect
		},
		methods: {
			async clear() {
				this.name = this.email = this.select = this.checkbox = this.password = "";
				this.$nextTick(() => {
					this.$refs.obs.reset();
				});
			},
			async submit() {
				const result = await this.$refs.obs.validate();
			}
		}
	};
</script>
