export default () => ({
    loading: false,

    generateReport() {
        this.loading = true
        
        const sizes = this.$refs.vegalitecontainer.getBoundingClientRect()  //Gives access to height and width of view components

        this.$wire.generateReport()
            .then((result) => {
                const dataset = this.$wire.get('dataset')
                
                result.data = dataset
                result.height = sizes.height
                result.width = sizes.width

                console.log(dataset, result, sizes)

                window.vegaEmbed('#vis', result)
            })
            .catch((error) => {
                console.log(error)
            })
            .finally(() => {
                this.loading = false
            })
    }
})