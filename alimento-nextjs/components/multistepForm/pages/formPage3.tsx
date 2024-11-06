import TagSelector from '../components/tagSelector';

  const FormPage3 = () => {
  
    return (
      <div className="h-3/4 flex  flex-col items-start gap-8 justify-start">
        <h1 className="text-primary-marineBlue font-bold text-[1.6rem] md:text-4xl leading-9">
          Select Tags
        </h1>
        <h3 className="text-gray-400 mt-2">
          Please select the most appropriate tags for your dish
        </h3>
        <TagSelector/>
      </div>
    );
  };
  
  export default FormPage3;
  