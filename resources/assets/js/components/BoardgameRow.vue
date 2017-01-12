<template>
    <tr>
        <td>
            {{ data.name }}
        </td>
        <td>
            {{ parseFloat(Math.round(data.rating_bayes * 100) / 100).toFixed(2) }}
        </td>
        <td>
            {{ weight }}
        </td>
        <td>
            <template v-for="tag in data.tags"
                v-if="tag.type == 'boardgamecategory'">
                {{ tag.name }}
            </template>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['data'],
        computed: {
            weight: function () {
                var weights = ['Very Light', 'Light', 'Medium', 'Heavy', 'Very Heavy'];
                return weights[Math.floor(this.data.weight_average)];
            }
        }
    }
</script>
