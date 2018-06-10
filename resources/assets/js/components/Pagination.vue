<template>
<nav aria-label="Page navigation example">
	<ul class="pagination mb-0">
		<li class="page-item" :class="{ 'disabled':source.current_page == 1 }">
			<a class="page-link" href="#" @click="navigate($event, source.current_page - 1)">Previous</a>
		</li>
		
		<li class="page-item" v-for="page in pages.slice(start, start + 5)" :class="{ 'active': source.current_page == page }">
			<a class="page-link" href="#" @click="navigate($event, page)">{{page}}</a>
		</li>

		<li class="page-item" :class="{ 'disabled':source.current_page == source.last_page }">
			<a class="page-link" href="#" @click="navigate($event, source.current_page + 1)">Next</a>
		</li>
	</ul>
</nav>
</template>

<script>
	export default{
		props: ['source'],

		data(){
			return {
				pages:[],
				start: 0,
			}
		},

		methods:{
			navigate(event, pages){
				if (page > this.start + 5)
					this.start = this.start + 1
				if (page <= this.start)
					this.start = this.start - 1

				event.preventDefault()
				
				this.$emit('navigate', page)
			}
		},

		watch:{
			source(){
				this.pages = _.range(1, this.source.last_page + 1)
			}
		}
	}
</script>