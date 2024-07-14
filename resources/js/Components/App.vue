<script setup>
import {onMounted, reactive, ref, watch} from "vue";

const baseUrl = reactive(new URL(window.location.href));

const entities = ref([]);
const total = ref(1);

const pagination = reactive({
  perPage: baseUrl.searchParams.get('perPage') ?? 10,
  page: baseUrl.searchParams.get('page') ?? 1,
})

const processing = ref(false);

const filters = reactive({
  q: baseUrl.searchParams.get('q') ?? null,
  bedrooms: baseUrl.searchParams.get('bedrooms') ?? null,
  bathrooms: baseUrl.searchParams.get('bathrooms') ?? null,
  storeys: baseUrl.searchParams.get('storeys') ?? null,
  garages: baseUrl.searchParams.get('garages') ?? null,
  price_from: baseUrl.searchParams.get('price_from') ?? null,
  price_to: baseUrl.searchParams.get('price_to') ?? null,
})

function load() {
  processing.value = true;
  axios.get('/api/v1/entities', {params: {...pagination, ...filters}})
      .then((response) => {
        entities.value = response.data.data;
        pagination.perPage = response.data.meta.per_page;
        total.value = response.data.meta.total
      })
      .finally(() => {
        processing.value = false;
      })
}

function clearFilters() {
  Object.keys(filters).forEach((k) => {
    filters[k] = null;
  })
  pagination.page = 1;
  load();
}

function applyFilters() {
  pagination.page = 1;
  load()
}

onMounted(() => load());

watch(pagination, () => {
  load()
})

</script>

<template>
  <div class="common-layout">
    <el-container style="width: 1000px; margin: 0 auto">
      <el-main>
        <el-space
            fill
            wrap
            style="width: 100%"
        >
          <el-card class="box-card">
            <el-form label-width="auto">
              <el-form-item label="Name">
                <el-input v-model="filters.q"/>
              </el-form-item>
              <el-form-item label="Bedrooms">
                <el-input-number v-model="filters.bedrooms"/>
              </el-form-item>
              <el-form-item label="Bathrooms">
                <el-input-number v-model="filters.bathrooms"/>
              </el-form-item>
              <el-form-item label="Storeys">
                <el-input-number v-model="filters.storeys"/>
              </el-form-item>
              <el-form-item label="Price">
                <el-col :span="11">
                  <el-input v-model="filters.price_from"/>
                </el-col>
                <el-col :span="2" class="text-center">
                  <span class="text-gray-500">-</span>
                </el-col>
                <el-col :span="11">
                  <el-input v-model="filters.price_to"/>
                </el-col>
              </el-form-item>
              <el-form-item>
                <el-button type="primary" @click.prevent="load">
                  <el-icon class="is-loading" v-if="processing">
                    <Loading />
                  </el-icon>
                  Search
                </el-button>
                <el-button @click.prevent="clearFilters">Clear</el-button>
              </el-form-item>
            </el-form>
          </el-card>
        </el-space>
        <el-table :data="entities" style="width: 100%">
          <el-table-column prop="name" label="Name"/>
          <el-table-column prop="price" label="Price"/>
          <el-table-column prop="bedrooms" label="Bedrooms"/>
          <el-table-column prop="bathrooms" label="Bathrooms"/>
          <el-table-column prop="storeys" label="Storeys"/>
          <el-table-column prop="garages" label="Garages"/>
        </el-table>
        <el-row :gutter="12">
          <el-col :span="12">
            <div class="grid-content ep-bg-purple"/>
            <el-pagination
                layout="total, prev, pager, next, sizes"
                :total="total"
                :page-sizes="[10, 20, 50, 100]"
                v-model:current-page="pagination.page"
                v-model:page-size="pagination.perPage"
                @size-change="load"
                @current-change="load"
            />
          </el-col>
        </el-row>
      </el-main>
    </el-container>
  </div>
</template>

<style scoped>

</style>
