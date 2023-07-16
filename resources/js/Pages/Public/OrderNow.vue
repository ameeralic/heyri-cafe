<template>
    <img :src="$page.props.siteLogo" class="h-24 mx-auto" alt="" />
    <p class="font-merienda font-bold text-xl text-center mb-10 mx-auto">
        heyri cafe
    </p>

    <p class="font-raleway text-2xl text-center font-bold underline">Order</p>
    <div class="px-10 py-10">
        <div class="grid md:grid-cols-2 gap-4 mb-10">
            <div class="space-y-4">
                <FormSimpleInput
                    :label="'Your Name'"
                    :name="'name'"
                    :type="'name'"
                    v-model="orderInfo.name"
                    :error="errors.name"
                >
                </FormSimpleInput>
                <FormSimpleInput
                    :label="'Your Email'"
                    :name="'email'"
                    :type="'email'"
                    v-model="orderInfo.email"
                    :error="errors.email"
                >
                </FormSimpleInput>
                <FormSimpleInput
                    :label="'Your Phone Number'"
                    :name="'phone_number'"
                    :type="'phone_number'"
                    v-model="orderInfo.phone_number"
                    :error="errors.phone_number"
                >
                </FormSimpleInput>
                <FormSimpleInput
                    :label="'Delivery Address'"
                    :name="'delivery_address'"
                    :type="'delivery_address'"
                    v-model="orderInfo.delivery_address"
                    :error="errors.delivery_address"
                >
                </FormSimpleInput>
            </div>
            <div class="space-y-4">
                <FormTextEditor
                    :label="'Delivery note'"
                    :error="errors.delivery_note"
                >
                </FormTextEditor>
            </div>
        </div>
        <div class="flex flex-col-reverse md:flex-row md:space-x-9">
            <div class="space-y-4 md:w-3/4 w-full md:space-x-3">
                <p
                    class="font-raleway underline font-bold text-xl mb-5 mx-auto"
                    id="menu"
                >
                    Menu
                </p>
                <div>
                    <div v-for="(value, key, index) in menu" :key="index">
                        <p class="text-xl font-bold my-2">
                            {{ key }}
                        </p>
                        <div class="space-y-4">
                            <div
                                class="grid grid-cols-12 gap-2"
                                v-for="item in value"
                                :key="item"
                            >
                                <div class="col-span-8 text-lg">
                                    {{ item.name }}
                                </div>
                                <div class="col-span-2 text-lg">
                                    {{ item.price }}
                                </div>
                                <div
                                    class="col-span-2 w-10 h-fit grid text-lg cursor-pointer bg-darkGreen hover:bg-olive text-white text-center rounded-full"
                                >
                                    <button @click="addItemToCart(item)">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-4 md:w-1/2 w-full mb-10">
                <p
                    class="font-raleway underline font-bold text-xl mb-5 mx-auto"
                    id="menu"
                >
                    Order Items
                </p>
                <div class="space-y-2">
                    <div
                        class="grid grid-cols-12 gap-2 text-base bg-darkGreen text-white pl-4 py-2 rounded"
                        v-for="item in cart"
                        :key="item"
                    >
                        <div class="col-span-8">{{ item.name }}</div>
                        <div class="col-span-2">{{ item.price }}</div>
                        <div class="col-span-2">x{{ item.quantity }}</div>
                    </div>
                </div>
                <div>
                    <p class="font-raleway font-bold text-xl text-right">
                        Total: {{ cartTotal }}
                    </p>
                </div>
                <div>
                    <Link href="/orders/thank-you">
                        <button class="w-full bg-olive text-white px-2 py-2 rounded-full font-bold font-raleway hover:bg-darkGreen">Order Now</button>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["errors"],
    data() {
        return {
            orderInfo: {},
            cart: [],
            menu: {
                Beverages: [
                    {
                        name: "Espresso",
                        price: 3.5,
                        quantity: 0,
                    },
                    {
                        name: "Americano",
                        price: 4.0,
                        quantity: 0,
                    },
                    {
                        name: "Cappuccino",
                        price: 4.5,
                        quantity: 0,
                    },
                    {
                        name: "Latte (Regular/Mocha/Vanilla/Hazelnut)",
                        price: 5.0,
                        quantity: 0,
                    },
                    {
                        name: "Macchiato",
                        price: 4.5,
                        quantity: 0,
                    },
                    {
                        name: "Flat White",
                        price: 4.5,
                        quantity: 0,
                    },
                    {
                        name: "Iced Coffee (Regular/Mocha/Vanilla/Hazelnut)",
                        price: 4.5,
                        quantity: 0,
                    },
                    {
                        name: "Cold Brew (Regular/Flavored)",
                        price: 5.0,
                        quantity: 0,
                    },
                    {
                        name: "Frappuccino (Mocha/Caramel/Vanilla/Matcha)",
                        price: 6.0,
                        quantity: 0,
                    },
                    {
                        name: "Hot Chocolate",
                        price: 4.5,
                        quantity: 0,
                    },
                    {
                        name: "Tea (Assorted Varieties)",
                        price: 4.0,
                        quantity: 0,
                    },
                    {
                        name: "Freshly Squeezed Juices",
                        price: 5.0,
                        quantity: 0,
                    },
                    {
                        name: "Smoothies (Strawberry/Banana/Mixed Berry/Mango)",
                        price: 6.0,
                        quantity: 0,
                    },
                ],
                "Korean Desserts": [
                    {
                        name: "Patbingsu (Shaved Ice with Sweet Red Beans and Assorted Toppings)",
                        price: 8.5,
                        quantity: 0,
                    },
                    {
                        name: "Bungeoppang (Fish-Shaped Pastry with Sweet Red Bean Filling)",
                        price: 4.5,
                        quantity: 0,
                    },
                    {
                        name: "Ho-dduk (Korean Sweet Pancake with Cinnamon and Nuts)",
                        price: 5.0,
                        quantity: 0,
                    },
                    {
                        name: "Hotteok (Filled Korean Pancake with Honey, Brown Sugar, and Nuts)",
                        price: 4.5,
                        quantity: 0,
                    },
                    {
                        name: "Injeolmi Toast (Toasted Bread with Sticky Rice Cake and Sweet Soybean Powder)",
                        price: 6.0,
                        quantity: 0,
                    },
                    {
                        name: "Korean Rice Cakes (Assorted Flavors)",
                        price: 3.5,
                        quantity: 0,
                    },
                    {
                        name: "Yakgwa (Honey Cookies with Sesame Seeds)",
                        price: 3.5,
                        quantity: 0,
                    },
                    {
                        name: "Korean Hot Chocolate (with Korean Ingredients)",
                        price: 4.5,
                        quantity: 0,
                    },
                ],
                Breakfast: [
                    {
                        name: "Croissant Sandwiches (Egg and Cheese/Ham and Cheese)",
                        price: 6.0,
                        quantity: 0,
                    },
                    {
                        name: "Avocado Toast with Poached Egg",
                        price: 7.5,
                        quantity: 0,
                    },
                    {
                        name: "Pancakes (Plain/Blueberry/Banana/Chocolate)",
                        price: 8.0,
                        quantity: 0,
                    },
                ],
            },
        };
    },
    computed: {
        cartTotal() {
            const initialValue = 0;
            return this.cart.reduce(
                (accumulator, currentValue) => accumulator + currentValue.price*currentValue.quantity, initialValue
            );
        },
    },
    methods: {
        addItemToCart(item) {
            if (this.cart.filter((e) => e.name === item.name).length > 0) {
                console.log("ss");
                item.quantity++;
            } else {
                this.cart.push(item);
                item.quantity = 1;
            }
        },
    },
};
</script>
<script setup>
import FormSimpleInput from "../../Shared/FormElements/FormSimpleInput.vue";
import FormTextEditor from "../../Shared/FormElements/FormTextEditor.vue";
</script>
