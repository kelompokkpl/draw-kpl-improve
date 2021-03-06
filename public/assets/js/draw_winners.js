new Vue({
	el: "#root",
	data: {
		selected_category: "",
		winners: [],
		winner: {
			id: "",
			participant_id: "",
			name: ""
		},
	},
	created() { 
	},
	methods: {
		getWinners() {
			axios.get(basepath+"/winners/"+this.selected_category)
				.then(response => (this.winners = response.data));
		},
	}
});