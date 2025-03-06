<template>
    <div class="register-form">
        <h2>Register</h2>
        <form @submit.prevent="register">
            <div>
                <label>Name:</label>
                <input type="text" v-model="form.name" required />
                <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
            </div>

            <div>
                <label>Email:</label>
                <input type="email" v-model="form.email" required />
                <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>
            </div>

            <div>
                <label>Password:</label>
                <input type="password" v-model="form.password" required />
                <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>
            </div>

            <div>
                <label>Confirm Password:</label>
                <input type="password" v-model="form.password_confirmation" required />
            </div>

            <button type="submit">Register</button>

            <p v-if="message" class="success">{{ message }}</p>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'RegisterForm', // Đảm bảo tên thành phần là chính xác
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            errors: {},
            message: ''
        };
    },
    mounted() {
        console.log('RegisterForm component has been mounted');
    },
    methods: {
        async register() {
            try {
                const response = await axios.post('/api/register', this.form);
                this.message = response.data.message;
                this.errors = {};
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                }
            }
        }
    }
};
</script>

<style>
.error { color: red; font-size: 14px; }
.success { color: green; font-size: 16px; }
</style>
