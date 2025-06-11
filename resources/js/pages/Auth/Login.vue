<template>
    <Head>
        <title>Login Account - Cashier App</title>
    </Head>
    <div class="col-md-4">
        <div class="fade-in">
            <div class="text-center md-4">
                <a href="" class="text-dark text-decoration-none">
                    <img src="/images/cash-machine.png" width="70" />
                    <h3 class="mt-2 font-weight-bold">Cashier App</h3>
                </a>
            </div>

            <div class="card-group">
                <div
                    class="card border-top-purple border-0 shadow-sm rounded-3"
                >
                    <div class="card-body">
                        <div class="text-start">
                            <h5>Login Account</h5>
                            <p class="text-muted">Sign In to your account</p>
                        </div>
                        <hr />
                        <div
                            v-if="session.status"
                            class="alert alert-success mt-2"
                        >
                            {{ session.status }}
                        </div>
                        <form @submit.prevent="submit">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input
                                    class="form-control"
                                    v-model="form.email"
                                    :class="{ 'is-invalid': errors.email }"
                                    type="email"
                                    placeholder="Email Address"
                                />
                            </div>
                            <div class="alert alert-danger" v-if="errors.email">
                                {{ errors.email }}
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input
                                    class="form-control"
                                    v-model="form.password"
                                    :class="{ 'is-invalid': errors.password }"
                                    type="password"
                                    placeholder="Password"
                                />
                            </div>
                            <div
                                class="alert alert-danger"
                                v-if="errors.password"
                            >
                                {{ errors.password }}
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3 text-end">
                                    <Link href="/forgot-password"
                                        >Forgot Password?</Link
                                    >
                                </div>
                                <div class="col-12">
                                    <button
                                        class="btn btn-primary shadow-sm rounded-sm px-4 w-100"
                                    >
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAuth from "../../layouts/Auth.vue";
import { reactive } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";

export default {
    layout: LayoutAuth,

    components: {
        Head,
        Link,
    },

    props: {
        errors: Object,
        session: Object,
    },

    setup() {
        const form = reactive({
            email: "",
            password: "",
        });

        const submit = () => {
            router.post("/login", {
                email: form.email,
                password: form.password,
            });
        };
        return { form, submit };
    },
};
</script>
